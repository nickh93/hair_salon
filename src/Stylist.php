<?php

    class Stylist
    {
        private $name;
        private $stylist_id;

        function __construct($stylist_name, $sty_id = null)
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
            $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getName()}');");
            $this->stylist_id = $GLOBALS['DB']->lastInsertId();
        }
        static function getAll()
        {
            $returned_stylists = $GLOBALS["DB"]->query("SELECT * FROM stylists;");
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
            $GLOBALS['DB']->exec("DELETE from stylists");
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
