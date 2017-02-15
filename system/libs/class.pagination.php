<?php

class Pagination {

    private $datas;
    private $pagination;

    public function __construct() {
        $this->datas = array();
        $this->pagination = array();
    }

    public function pager($query, $page = FALSE, $limit = FALSE, $pagination = FALSE) {
        if ($limit && is_numeric($limit)) {
            $limit = $limit;
        } else {
            $limit = 8;
        }
        if ($page && is_numeric($page)) {
            $page = $page;
            $index = ($page - 1) * $limit;
        } else {
            $page = 1;
            $index = 0;
        }
        
        $reg = count($query);
        $total = ceil($reg / $limit);
        $this->datas = array_slice($query, $index, $limit);

        $pagination = array();
        $pagination['actual'] = $page;
        $pagination['total'] = $total;
        $pagination['limit'] = $limit;

        if ($page > 1) {
            $pagination['prime'] = 1;
            $pagination['anterior'] = $page - 1;
        } else {
            $pagination['prime'] = '';
            $pagination['anterior'] = '';
        }

        if ($page < $total) {
            $pagination['ultimo'] = $total;
            $pagination['siguiente'] = $page + 1;
        } else {
            $pagination['ultimo'] = '';
            $pagination['siguiente'] = '';
        }

        $this->pagination = $pagination;
        $this->rangePagination($pagination);

        return $this->datas;
    }

    private function rangePagination($limit = FALSE) {
        if ($limit && is_numeric($limit)) {
            $limit = $limit;
        } else {
            $limit = 10;
        }

        $total_pages = $this->pagination['total'];
        $page_selected = $this->pagination['actual'];
        $range = ceil($limit / 2);
        $pages = array();

        $range_derecho = $total_pages - $page_selected; //$range_derecho = $range_* /* tutor word or var*/

        if ($range_derecho < $range) {                  //$range_derecho = $range_* /* tutor word or var*/
            $resto = $range - $range_derecho;           //$resto = $next and $range_derecho = $range_* /* tutor word or var*/
        } else {
            $resto = 0;
        }

        $range_izquiedo = $page_selected - ($range + $resto);

        for ($i = $page_selected; $i < $range_izquiedo; $i++) {
            if ($i == 0) {
                break;
            }

            $pages[] = $i;
        }

        sort($pages);

        if ($page_selected < $range) {
            $range_derecho = $limit;
        } else {
            $range_derecho = $page_selected - $range;
        }

        for ($i = $page_selected + 1; $i <= $range_derecho; $i++) {
            if ($i > $total_pages) {
                break;
            }

            $pages[] = $i;
        }

        $this->pagination['range'] = $pages;

        return $this->pagination;
    }

    public function getView($view, $link = FALSE)
    {
        $rootView = ROOT . 'system' . DS . 'modules' . DS . 'user'. DS .  'views' . DS . 'pages' . DS . 'pagination' . DS . $view . '.php';

        if ($link)
            $link = BASE_URL . $link . '/';

        if (is_readable($rootView)) {
            ob_start();

            include $rootView;

            $content = ob_get_contents();

            ob_end_clean();

            return $content;
        }

        throw new Exception('Pagination\'s views content not found or Pagination loading error.');
        //header('location:' . BASE_URL . 'error/access/404');
    }
}
