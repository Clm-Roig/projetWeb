<?php
include('../config/connexionBD.php');

class newsRefersTo {

    // ========= ATTRIBUTES ========= //
    private $newsRefersToNewsId;    // integer
    private $newsRefersToBandId;    // integer
    // ============================= //


    // ==== Simple requests ==== //
    public function getAllNewsRefersTo() {
        $req = myPDO()->prepare('SELECT * FROM news_refers_to');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_CLASS, "newsRefersTo");
        return json_encode($object);
    }

    public function countNewsRefersTo() {
        $req = myPDO()->prepare('SELECT news_refers_to_band_id FROM news_refers_to');
        $req->execute();
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getNewsRefersToByNewsId($newsRefersToNewsId) {
        $req = myPDO()->prepare('SELECT * FROM news_refers_to WHERE news_refers_to_news_id = :news_refers_to_news_id');
        $req->execute(array(':news_refers_to_news_id' => $newsRefersToNewsId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "newsRefersTo");
        return json_encode($object);
    }

    public function getNewsRefersToByBandId($newsRefersToBandId) {
        $req = myPDO()->prepare('SELECT * FROM news_refers_to WHERE news_refers_to_band_id = :news_refers_to_band_id');
        $req->execute(array(':news_refers_to_band_id' => $newsRefersToBandId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "newsRefersTo");
        return json_encode($object);
    }

    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertNewsRefersTo($newsRefersToBandId, $newsRefersToNewsId) {
        $newsRefersToId = $this->getIdMax() + 1;
        $sql = "INSERT INTO news_refers_to VALUES (:news_refers_to_band_id, :news_refers_to_news_id)";
        $req = myPdo()->prepare($sql);
        $params = [
          ':news_refers_to_band_id' => $newsRefersToBandId,
          ':news_refers_to_news_id' => $newsRefersToNewsId
        ];
        try {
            $req->execute($params);
            return true;
        }
        catch (Exception $e) {
            echo 'Error request "'.$sql.'" : ';
            var_dump($e->getMessage());
            return false;
        }
    }

    public function deleteNewsRefersTo($newsRefersToBandId, $newsRefersToNewsId) {
        $sql = "DELETE FROM news_refers_to WHERE news_refers_to_band_id = :news_refers_to_band_id AND news_refers_to_news_id=:news_refers_to_news_id";
        $req = myPdo()->prepare($sql);
        $params = [
          ':news_refers_to_band_id' => $newsRefersToBandId,
          ':news_refers_to_news_id' => $newsRefersToNewsId
        ];
        try {
            $req->execute($params);
            return true;
        }
        catch (Exception $e) {
            echo 'Error request "'.$sql.'" : ';
            var_dump($e->getMessage());
            return false;
        }
    }
    // ====================================== //

    // ==== Complex requests ==== //

}