<?php 
namespace models;
class admin extends database implements base
{
    public function Insert(array $data)
    {
        $this->SendData("INSERT INTO admins (UserName, Passwd, AdLogin, EmailAdmin, AdRole, Statut) VALUES (?,?,?,?,?,?",$data);
    }
    public function Update(array $data)
    {
        $this->SendData("UPDATE admins SET UserName=?, AdLogin=?, EmailAdmin=?, AdRole=?, Statut=? WHERE Id=?",$data);
    }
    public function Delete(int $id)
    {
        $this->SendData("DELETE FROM admins WHERE Id=?",[$id]);
    }
    public function GetAll()
    {
        return $this->GetManyData("SELECT Id, UserName,  AdLogin, EmailAdmin, AdRole, Statut FROM admins");
    }
    public function GetById(int $id)
    {
        return $this->GetOneData("SELECT Id, UserName,  AdLogin, EmailAdmin, AdRole, Statut FROM admins WHERE Id=?",[$id]);
    }
    public function GetByAdLogin(string $login)
    {
        return $this->GetOneData("SELECT Id, UserName,  AdLogin, Passwd, EmailAdmin, AdRole, Statut FROM admins WHERE AdLogin=?",[$login]);
    }
    public function UpdateAdPasswd(array $data)
    {
        $this->SendData("UPDATE admins SET Passwd=? WHERE Id=?",$data);
    }
}