<?php


class User
{
    public function __construct()
    {
        $this-> pdo = new PDO(
            'mysql:host=localhost;dbname=php_dev',
            'root',
            'sokkenai'
        );
    }
        public function getUser(string $value='', string $field = 'id'): array
        {
            $query = $this -> pdo -> prepare(
                "SELECT * FROM users WHERE $field = :value"
            );
            $query -> bindParam(":value", $value, PDO::PARAM_STR);
            $query -> execute();


            $user = $query -> fetch(PDO::FETCH_ASSOC);
            return $user ? $user : [];


        }

        public function getMe()
        {

        }


        public function postUser(array $data): bool
    {
    try{
        $query = $this -> pdo -> prepare(
        "INSERT INTO users (id, name, email, password, last_seen) VALUES (null, :name, :email, :password, null)"
         );

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        $query -> bindParam(':name', $data['name'], PDO::PARAM_STR);
        $query -> bindParam(':email', $data['email'], PDO::PARAM_STR);
        $query -> bindParam(':password', $data['password'], PDO::PARAM_STR);

        return $query -> execute();
    }catch(PDOException $e){
        echo 'deu merda na funsao';
        echo $e -> getMessage();
        die();
    }

    }

    }

