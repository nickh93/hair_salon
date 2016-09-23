<?php

    class Client
    {
        private $name;
        private $client_id;

        function __construct($client_name, $cli_id = null)
        {
            $this->name = $client_name;
            $this->client_id = $cli_id;
        }

        function getId()
        {
            return $this->client_id;
        }
        function setName($client_name)
        {
            $this->name = $client_name;
        }
        function getName()
        {
            return $this->name;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO client (name) VALUES ('{$this->getName()}');");
            $this->client_id = $GLOBALS['DB']->lastInsertId();
        }
        function getAll()
        {
            $returned_clients = $GLOBAL["DB"]->query("SELECT * FROM client;");
            $clients = array();
            foreach ($returned_clients as $client)
            {
                $name = $client['name'];
                $client_id = $client['id'];
                $new_client = new Client($name, $client_id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE from client");
        }
        static function find($search_id)
        {
            $found_client = null;
            $clients = Client::getAll();
            foreach($clients as $client)
            {
                $client_id = $client->getId();
                if ($client_id == $search_id)
                {
                    $found_client = $client;
                }
            }
            return $found_client;
        }
    }

?>
