<?php
class Pagination
{
    public $page;
    public $tpages;
    public $adjacents;

    function __construct($page, $tpages, $adjacents)
    {
        $this->page = $page;
        $this->tpages  = $tpages;
        $this->adjacents   = $adjacents;
    }

    public function paginateCartera()
    {

        $page = $this->page;
        $tpages = $this->tpages;
        $adjacents = $this->adjacents;

        $prevlabel = "&lsaquo; Anterior";
        $nextlabel = "Siguiente &rsaquo;";
        $out = '<ul class="pagination   pull-right">';
        // previous label

        if ($page == 1) {
            $out .= "<li class='page-item disabled'><a class='page-link'>$prevlabel</a></li>";
        } else if ($page == 2) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarCartera(1)'>$prevlabel</a></li>";
        } else {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarCartera(" . ($page - 1) . ")'>$prevlabel</a></li>";
        }
        // first label
        if ($page > ($adjacents + 1)) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarCartera(1)'>1</a></li>";
        }
        // interval
        if ($page > ($adjacents + 2)) {
            $out .= "<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // pages

        $pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
        $pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
        for ($i = $pmin; $i <= $pmax; $i++) {
            if ($i == $page) {
                $out .= "<li class='active page-item'><a class='page-link'>$i</a></li>";
            } else if ($i == 1) {
                $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarCartera(1)'>$i</a></li>";
            } else {
                $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarCartera(" . $i . ")'>$i</a></li>";
            }
        }

        // interval

        if ($page < ($tpages - $adjacents - 1)) {
            $out .= "<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // last

        if ($page < ($tpages - $adjacents)) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarCartera($tpages)'>$tpages</a></li>";
        }

        // next

        if ($page < $tpages) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarCartera(" . ($page + 1) . ")'>$nextlabel</a></li>";
        } else {
            $out .= "<li class='disabled page-item'><a class='page-link'>$nextlabel</a></li>";
        }
        $out .= "</ul>";
        return $out;
    }


    public function paginateProspectos()
    {

        $page = $this->page;
        $tpages = $this->tpages;
        $adjacents = $this->adjacents;

        $prevlabel = "&lsaquo; Anterior";
        $nextlabel = "Siguiente &rsaquo;";
        $out = '<ul class="pagination   pull-right">';
        // previous label

        if ($page == 1) {
            $out .= "<li class='page-item disabled'><a class='page-link'>$prevlabel</a></li>";
        } else if ($page == 2) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarProspectos(1)'>$prevlabel</a></li>";
        } else {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarProspectos(" . ($page - 1) . ")'>$prevlabel</a></li>";
        }
        // first label
        if ($page > ($adjacents + 1)) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarProspectos(1)'>1</a></li>";
        }
        // interval
        if ($page > ($adjacents + 2)) {
            $out .= "<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // pages

        $pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
        $pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
        for ($i = $pmin; $i <= $pmax; $i++) {
            if ($i == $page) {
                $out .= "<li class='active page-item'><a class='page-link'>$i</a></li>";
            } else if ($i == 1) {
                $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarProspectos(1)'>$i</a></li>";
            } else {
                $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarProspectos(" . $i . ")'>$i</a></li>";
            }
        }

        // interval

        if ($page < ($tpages - $adjacents - 1)) {
            $out .= "<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // last

        if ($page < ($tpages - $adjacents)) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarProspectos($tpages)'>$tpages</a></li>";
        }

        // next

        if ($page < $tpages) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarProspectos(" . ($page + 1) . ")'>$nextlabel</a></li>";
        } else {
            $out .= "<li class='disabled page-item'><a class='page-link'>$nextlabel</a></li>";
        }
        $out .= "</ul>";
        return $out;
    }
    public function paginateOportunidades()
    {

        $page = $this->page;
        $tpages = $this->tpages;
        $adjacents = $this->adjacents;

        $prevlabel = "&lsaquo; Anterior";
        $nextlabel = "Siguiente &rsaquo;";
        $out = '<ul class="pagination   pull-right">';
        // previous label

        if ($page == 1) {
            $out .= "<li class='page-item disabled'><a class='page-link'>$prevlabel</a></li>";
        } else if ($page == 2) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarOportunidades(1)'>$prevlabel</a></li>";
        } else {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarOportunidades(" . ($page - 1) . ")'>$prevlabel</a></li>";
        }
        // first label
        if ($page > ($adjacents + 1)) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarOportunidades(1)'>1</a></li>";
        }
        // interval
        if ($page > ($adjacents + 2)) {
            $out .= "<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // pages

        $pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
        $pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
        for ($i = $pmin; $i <= $pmax; $i++) {
            if ($i == $page) {
                $out .= "<li class='active page-item'><a class='page-link'>$i</a></li>";
            } else if ($i == 1) {
                $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarOportunidades(1)'>$i</a></li>";
            } else {
                $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarOportunidades(" . $i . ")'>$i</a></li>";
            }
        }

        // interval

        if ($page < ($tpages - $adjacents - 1)) {
            $out .= "<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // last

        if ($page < ($tpages - $adjacents)) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarOportunidades($tpages)'>$tpages</a></li>";
        }

        // next

        if ($page < $tpages) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarOportunidades(" . ($page + 1) . ")'>$nextlabel</a></li>";
        } else {
            $out .= "<li class='disabled page-item'><a class='page-link'>$nextlabel</a></li>";
        }
        $out .= "</ul>";
        return $out;
    }
    public function paginateClientes()
    {

        $page = $this->page;
        $tpages = $this->tpages;
        $adjacents = $this->adjacents;

        $prevlabel = "&lsaquo; Anterior";
        $nextlabel = "Siguiente &rsaquo;";
        $out = '<ul class="pagination   pull-right">';
        // previous label

        if ($page == 1) {
            $out .= "<li class='page-item disabled'><a class='page-link'>$prevlabel</a></li>";
        } else if ($page == 2) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarClientes(1)'>$prevlabel</a></li>";
        } else {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarClientes(" . ($page - 1) . ")'>$prevlabel</a></li>";
        }
        // first label
        if ($page > ($adjacents + 1)) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarClientes(1)'>1</a></li>";
        }
        // interval
        if ($page > ($adjacents + 2)) {
            $out .= "<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // pages

        $pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
        $pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
        for ($i = $pmin; $i <= $pmax; $i++) {
            if ($i == $page) {
                $out .= "<li class='active page-item'><a class='page-link'>$i</a></li>";
            } else if ($i == 1) {
                $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarClientes(1)'>$i</a></li>";
            } else {
                $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarClientes(" . $i . ")'>$i</a></li>";
            }
        }

        // interval

        if ($page < ($tpages - $adjacents - 1)) {
            $out .= "<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // last

        if ($page < ($tpages - $adjacents)) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarClientes($tpages)'>$tpages</a></li>";
        }

        // next

        if ($page < $tpages) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarClientes(" . ($page + 1) . ")'>$nextlabel</a></li>";
        } else {
            $out .= "<li class='disabled page-item'><a class='page-link'>$nextlabel</a></li>";
        }
        $out .= "</ul>";
        return $out;
    }
     public function paginateVentasPeriodo()
    {

        $page = $this->page;
        $tpages = $this->tpages;
        $adjacents = $this->adjacents;

        $prevlabel = "&lsaquo; Anterior";
        $nextlabel = "Siguiente &rsaquo;";
        $out = '<ul class="pagination   pull-right">';
        // previous label

        if ($page == 1) {
            $out .= "<li class='page-item disabled'><a class='page-link'>$prevlabel</a></li>";
        } else if ($page == 2) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarVentasPeriodo(1)'>$prevlabel</a></li>";
        } else {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarVentasPeriodo(" . ($page - 1) . ")'>$prevlabel</a></li>";
        }
        // first label
        if ($page > ($adjacents + 1)) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarVentasPeriodo(1)'>1</a></li>";
        }
        // interval
        if ($page > ($adjacents + 2)) {
            $out .= "<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // pages

        $pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
        $pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
        for ($i = $pmin; $i <= $pmax; $i++) {
            if ($i == $page) {
                $out .= "<li class='active page-item'><a class='page-link'>$i</a></li>";
            } else if ($i == 1) {
                $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarVentasPeriodo(1)'>$i</a></li>";
            } else {
                $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarVentasPeriodo(" . $i . ")'>$i</a></li>";
            }
        }

        // interval

        if ($page < ($tpages - $adjacents - 1)) {
            $out .= "<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // last

        if ($page < ($tpages - $adjacents)) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarVentasPeriodo($tpages)'>$tpages</a></li>";
        }

        // next

        if ($page < $tpages) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarVentasPeriodo(" . ($page + 1) . ")'>$nextlabel</a></li>";
        } else {
            $out .= "<li class='disabled page-item'><a class='page-link'>$nextlabel</a></li>";
        }
        $out .= "</ul>";
        return $out;
    }
    public function paginateEventos()
    {

        $page = $this->page;
        $tpages = $this->tpages;
        $adjacents = $this->adjacents;

        $prevlabel = "&lsaquo; Anterior";
        $nextlabel = "Siguiente &rsaquo;";
        $out = '<ul class="pagination   pull-right">';
        // previous label

        if ($page == 1) {
            $out .= "<li class='page-item disabled'><a class='page-link'>$prevlabel</a></li>";
        } else if ($page == 2) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarEventos(1)'>$prevlabel</a></li>";
        } else {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarEventos(" . ($page - 1) . ")'>$prevlabel</a></li>";
        }
        // first label
        if ($page > ($adjacents + 1)) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarEventos(1)'>1</a></li>";
        }
        // interval
        if ($page > ($adjacents + 2)) {
            $out .= "<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // pages

        $pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
        $pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
        for ($i = $pmin; $i <= $pmax; $i++) {
            if ($i == $page) {
                $out .= "<li class='active page-item'><a class='page-link'>$i</a></li>";
            } else if ($i == 1) {
                $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarEventos(1)'>$i</a></li>";
            } else {
                $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarEventos(" . $i . ")'>$i</a></li>";
            }
        }

        // interval

        if ($page < ($tpages - $adjacents - 1)) {
            $out .= "<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // last

        if ($page < ($tpages - $adjacents)) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarEventos($tpages)'>$tpages</a></li>";
        }

        // next

        if ($page < $tpages) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarEventos(" . ($page + 1) . ")'>$nextlabel</a></li>";
        } else {
            $out .= "<li class='disabled page-item'><a class='page-link'>$nextlabel</a></li>";
        }
        $out .= "</ul>";
        return $out;
    }
     public function paginateBitacora()
    {

        $page = $this->page;
        $tpages = $this->tpages;
        $adjacents = $this->adjacents;

        $prevlabel = "&lsaquo; Anterior";
        $nextlabel = "Siguiente &rsaquo;";
        $out = '<ul class="pagination   pull-right">';
        // previous label

        if ($page == 1) {
            $out .= "<li class='page-item disabled'><a class='page-link'>$prevlabel</a></li>";
        } else if ($page == 2) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarBitacora(1)'>$prevlabel</a></li>";
        } else {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarBitacora(" . ($page - 1) . ")'>$prevlabel</a></li>";
        }
        // first label
        if ($page > ($adjacents + 1)) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarBitacora(1)'>1</a></li>";
        }
        // interval
        if ($page > ($adjacents + 2)) {
            $out .= "<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // pages

        $pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
        $pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
        for ($i = $pmin; $i <= $pmax; $i++) {
            if ($i == $page) {
                $out .= "<li class='active page-item'><a class='page-link'>$i</a></li>";
            } else if ($i == 1) {
                $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarBitacora(1)'>$i</a></li>";
            } else {
                $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarBitacora(" . $i . ")'>$i</a></li>";
            }
        }

        // interval

        if ($page < ($tpages - $adjacents - 1)) {
            $out .= "<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // last

        if ($page < ($tpages - $adjacents)) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarBitacora($tpages)'>$tpages</a></li>";
        }

        // next

        if ($page < $tpages) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarBitacora(" . ($page + 1) . ")'>$nextlabel</a></li>";
        } else {
            $out .= "<li class='disabled page-item'><a class='page-link'>$nextlabel</a></li>";
        }
        $out .= "</ul>";
        return $out;
    }
     public function paginateSeguimientos()
    {

        $page = $this->page;
        $tpages = $this->tpages;
        $adjacents = $this->adjacents;

        $prevlabel = "&lsaquo; Anterior";
        $nextlabel = "Siguiente &rsaquo;";
        $out = '<ul class="pagination   pull-right">';
        // previous label

        if ($page == 1) {
            $out .= "<li class='page-item disabled'><a class='page-link'>$prevlabel</a></li>";
        } else if ($page == 2) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarSeguimientos(1)'>$prevlabel</a></li>";
        } else {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarSeguimientos(" . ($page - 1) . ")'>$prevlabel</a></li>";
        }
        // first label
        if ($page > ($adjacents + 1)) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarSeguimientos(1)'>1</a></li>";
        }
        // interval
        if ($page > ($adjacents + 2)) {
            $out .= "<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // pages

        $pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
        $pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
        for ($i = $pmin; $i <= $pmax; $i++) {
            if ($i == $page) {
                $out .= "<li class='active page-item'><a class='page-link'>$i</a></li>";
            } else if ($i == 1) {
                $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarSeguimientos(1)'>$i</a></li>";
            } else {
                $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarSeguimientos(" . $i . ")'>$i</a></li>";
            }
        }

        // interval

        if ($page < ($tpages - $adjacents - 1)) {
            $out .= "<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // last

        if ($page < ($tpages - $adjacents)) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarSeguimientos($tpages)'>$tpages</a></li>";
        }

        // next

        if ($page < $tpages) {
            $out .= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='cargarSeguimientos(" . ($page + 1) . ")'>$nextlabel</a></li>";
        } else {
            $out .= "<li class='disabled page-item'><a class='page-link'>$nextlabel</a></li>";
        }
        $out .= "</ul>";
        return $out;
    }
 
}
