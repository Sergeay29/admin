<?php
namespace models;
interface base
{
    public function Insert(array $data);
    public function Update(array $data);
    public function Delete(int $id);
    public function GetAll();
    public function GetById(int $id);
}