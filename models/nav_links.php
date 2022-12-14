<?php
namespace models;

class nav_links extends database implements base
{
    public function Insert(array $data){
        $this->SendData("INSERT INTO nav_links( LinksName, navGoto, navTarget, UserRole) VALUES (?,?,?,?)",$data);
    }
    public function Update(array $data){
        $this->SendData("UPDATE nav_links SET LinksName=?,navGoto=?,navTarget=?,UserRole=? WHERE Id=?",$data);
    }
    public function Delete(int $id){
        $this->SendData("DELETE FROM nav_links WHERE Id=?",[$id]);
    }
    public function GetAll(): array{
        return $this->GetManyData("SELECT Id,LinksName, navGoto, navTarget, UserRole FROM nav_links",NULL);
    }
    public function GetById(int $id){
        return $this->GetOneData("SELECT Id,LinksName, navGoto, navTarget, UserRole FROM nav_links WHERE Id=?",[$id]);
    }
    public function GetByRole(?int $role)
    {
        return $this->GetManyData("SELECT Id,LinksName, navGoto, navTarget, UserRole FROM nav_links WHERE UserRole<=?",[$role]);
    }
}