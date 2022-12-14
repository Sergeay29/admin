<?php
namespace models;
include_once 'asset/config/env.php';
abstract class database
{
    /****
     * Fonction de connexion à la DBB en POO
     * @return string | object
     */
    protected function ConnectDB()
    {
        try {
            $bdd = new \PDO("mysql:host=" . $_ENV['host'] . ";dbname=" . $_ENV['bdd'], $_ENV['userbd'], $_ENV['password']);
            $bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $bdd;
        } catch (\PDOException $e) {
            return " Une erreur est retrouvée : " . $e->getMessage();
        }
    }
    /****
     * Fonction d'envoi de données.
     * @param $request string
     * @param $data array
     * @return string
     */
    protected function SendData(string $request, array $data)
    {
        try {
            $bdd = $this->ConnectDB();
            $requette = $bdd->prepare($request);
            $requette->execute($data);
        } catch (\PDOException $e) {
            return " Une erreur est retrouvée : " . $e->getMessage();
        }
    }
    /****
     * Fonction de recupération d'une ligne.
     * @param $request string
     * @param $data array
     * @return string |array
     */
    protected function GetOneData(string $request, ?array $data=NULL)
    {
        try {
            $bdd = $this->ConnectDB();
            $requette = $bdd->prepare($request);
            $requette->execute($data);
            return $requette->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return " Une erreur est retrouvée : " . $e->getMessage();
        }
    }
    /****
     * Fonction de recupération multi-lignes.
     * @param $request string
     * @param $data array
     * @return string | array
     */
    protected function GetManyData($request, ?array $data=NULL)
    {
       
       
        try {
            $bdd = $this->ConnectDB();
            $requette = $bdd->prepare($request);
            $requette->execute($data);
            return $requette->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return " Une erreur est retrouvée : " . $e->getMessage();
        }
    }
}
