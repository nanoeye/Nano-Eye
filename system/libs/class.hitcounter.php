<?php

class HitCounter extends Visitor
{
    private $db;
    private $HitData;

    public function __construct()
    {
        try {
            $this->db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_CHAR);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage() . "<br/>";
            die();
        }

        $this->HitData = new stdClass();
        $this->HitData->total = 0;
        $this->HitData->unique = 0;

    }

    public function processViews()
    {
        $this->trackVisitor();
        $this->HitData = $this->getData();
        $this->visit($this->Visitor());
        $this->getMyHits();
    }

    public function trackVisitor()
    {
        if($this->Visitor() == $this->HostIPAddress()){}
        else {
            $do = $this->db->prepare("INSERT INTO visitor_details VALUES (null, :vIP, :vCountry, :vOS, :vBrowser, :vLocation, :vPageURL, :vPageTitle, now())");
            $do->execute(array(
                ':vIP' => $this->Visitor(),
                ':vCountry' => $this->VisitorCountry(),
                ':vOS' => $this->VisitorOS(),
                ':vBrowser' => $this->VisitorBrowser(),
                ':vLocation' => $this->VisitorInfo("Visitor", "Address"),
                ':vPageURL' => $this->VisitedPage(),
                ':vPageTitle' => ''// $this->VisitedPageTitle()
            ));
        }
    }

    public function getTotalHits()
    {
        $rows1 = $this->db->query("SELECT SUM(vTotalHits) AS TotalHits FROM `visitor` ");
        $row = $rows1->fetch(PDO::FETCH_ASSOC);
        return $row["TotalHits"];
    }

    public function getTotalVisitor()
    {
        $unique = $this->db->query("SELECT `vIP` FROM `visitor`");
        return $unique->rowcount();
    }

    public function getMyHits()
    {
        $visitor = $this->Visitor();
        $myHits = $this->db->query("SELECT `vTotalHits` FROM `visitor` WHERE `vIP` = '$visitor'");
        /*        $res1 = $db->prepare('SELECT sum(distance) FROM trip_logs WHERE user_id = '. $user_id .' AND status = "2"');
                $res1->execute();
                $sum_miles = 0;
                while($row1 = $res1->fetch(PDO::FETCH_ASSOC)) {
                    $sum_miles += $row1['distance'];
                }
                echo $sum_miles;*/

        if ($myHits->rowCount() == 1) {
            $hits = $myHits->fetch(PDO::FETCH_ASSOC);
            return $hits['vTotalHits'];
        }
    }


    private function getData()
    {
        $data = new stdClass();

        $results = $this->db->query("SELECT * FROM `visitor`");
        if ($results->rowcount() == 0) {

            $data->total = 0;
            $data->unique = 0;

            $stmt = $this->db->prepare("INSERT INTO `visitor`(`vIP`, `vTotalHits`) VALUES (:vIP, :vTotalHits)");
            $stmt->bindParam(':vIP', $this->Visitor());
            $stmt->bindParam(':vTotalHits', $data->total);
            $stmt->execute();
        }
    }

    private function isNewVisitor($visitor)
    {
        $id = $this->db->query("SELECT `vIP` FROM `visitor` WHERE `vIP` = '$visitor'");

        if ($id->fetch()) {
            return FALSE;
        }

        return TRUE;
    }

    private function visit($visitor)
    {
        $this->db->query("UPDATE `visitor` SET `vTotalHits` = `vTotalHits` + 1 WHERE `visitor`.`vIP` = '$visitor'");

        if ($this->isNewVisitor($visitor)) {
            $stmt = $this->db->prepare("INSERT INTO `visitor`(`vIP`) VALUES (:vIP)");
            $stmt->bindParam(':vIP', $this->Visitor());
            $stmt->execute();
        }
    }
}