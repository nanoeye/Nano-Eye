<?php

class profileModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUser($userId) {
        $user = $this->db->query(
                "SELECT u.*, ui.*, r.role FROM users u, users_info ui, roles r " .
                "WHERE u.role = r.id_role AND u.id = '$userId' "
        );

        return $user->fetch();
    }

    public function getActivities($username) {
        $activities = $this->db->query(
            "SELECT * FROM activities " .
            "WHERE author LIKE '%$username%'"
        );

        return $activities->fetchAll(PDO::FETCH_ASSOC);
    }

}
