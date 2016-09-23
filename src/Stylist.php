<?php

    class Stylist
    {
        private $name;
        private $stylist_id;

        function __construct($stylist_name, $sty_id = null);
        {
            $this->name = $stylist_name;
            $this->stylist_id = $sty_id;
        }

        function getId()
        {
            return $this->stylist_id;
        }
        function setName($stylist_name)
        {
            $this->name = $stylist_name;
        }
        function getName()
        {
            return $this->name;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stylist (name) VALUES ('{$this->getName()}');");
            $this->cuisine_id = $GLOBALS['DB']->lastInsertId();
        }
        function getAll()
        {
            $returned_stylists = $GLOBAL["DB"]->query("SELECT * FROM stylist;");
            $stylists = array();
            foreach ($returned_stylists as $stylist)
            {
                $name = $stylist['name'];
                $stylist_id = $stylist['id'];
                $new_stylist = new Stylist($name, $stylist_id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE from stylist");
        }
        static function find($search_id)
        {
            $found_stylist = null;
            $stylists = Stylist::getAll();
            foreach($stylists as $stylist)
            {
                $stylist_id = $stylist->getId();
                if ($stylist_id == $search_id)
                {
                    $found_stylist = $stylist;
                }
            }
            return $found_stylist;
        }
    }

?>
