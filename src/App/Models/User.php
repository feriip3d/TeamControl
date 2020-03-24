<?php
namespace App\Models;

class User implements \Nautilus\Resources\Model
{
    private ?int $id;
    private String $full_name;
    private String $username;
    private String $pass_hash;
    private String $email;
    private String $email_verified_at;
    private String $created_at;

    public function __construct()
    {
        $num_args = func_num_args();
        switch($num_args)
        {
            case 7:
                call_user_func_array([$this, "__construct1"], func_get_args());
                break;
            case 6:
                call_user_func_array([$this, "__construct2"], func_get_args());
                break;
        }
    }

    public function __construct1($id, $full_name, $username, $password, $email, $email_verified_at, $created_at)
    {
        $this->setId($id);
        $this->setFullName($full_name);
        $this->setUsername($username);
        $this->setPasswordHash($password);
        $this->setEmail($email);
        $this->setEmailVerification($email_verified_at);
        $this->setCreateDate($created_at);
    }

    public function __construct2($full_name, $username, $password, $email, $email_verified_at, $created_at)
    {
        $this->setFullName($full_name);
        $this->setUsername($username);
        $this->setPasswordHash($password);
        $this->setEmail($email);
        $this->setEmailVerification($email_verified_at);
        $this->setCreateDate($created_at);
    }

    private function setId($id) : void
    {
        if($id > 0)
            $this->id = $id;

        else
            $this->id = null;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setFullName($full_name) : void
    {
        $this->full_name = $full_name;
    }

    public function getFullName() : String
    {
        return $this->full_name;
    }

    public function setUsername($username) : void
    {
        $this->username = $username;
    }

    public function getUsername() : String
    {
        return $this->username;
    }

    public function getPasswordHash() : String
    {
        return $this->pass_hash;
    }

    public function setPasswordHash($password_hash) : void
    {
        $this->pass_hash = $password_hash;
    }

    public function newPasswordHash($password)
    {
        $this->pass_hash = password_hash($password, PASSWORD_BCRYPT);
    }

    public function setEmail($email) : void
    {
        $this->email = $email;
    }

    public function getEmail() : String
    {
        return $this->email;
    }

    public function getEmailVerification() : String
    {
        return $this->email_verified_at;
    }

    public function setEmailVerification($date) : void
    {
        $this->email_verified_at = $date;
    }

    public function getCreateDate() : String
    {
        return date("d/m/Y H:i:s", strtotime($this->created_at));
    }

    public function setCreateDate($date) : void
    {
        $this->created_at = $date;
    }

    public function serialize()
    {
        $instance = get_object_vars($this);
        $instance['created_at'] = date('d/m/Y H:i:s', strtotime($instance['created_at']));
        $instance['email_verified_at'] = date('d/m/Y H:i:s', strtotime($instance['email_verified_at']));
        unset($instance['pass_hash']);
        return json_encode($instance);
    }

    public function toArray()
    {
        $instance = get_object_vars($this);
        $instance['created_at'] = date('d/m/Y H:i:s', strtotime($instance['created_at']));
        $instance['email_verified_at'] = date('d/m/Y H:i:s', strtotime($instance['email_verified_at']));
        unset($instance['pass_hash']);
        return $instance;
    }
}