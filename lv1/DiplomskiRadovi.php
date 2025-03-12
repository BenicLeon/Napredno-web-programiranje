<?php
require_once "iRadovi.php";
require_once "Database.php";
require_once "Scraper.php";

class DiplomskiRadovi implements iRadovi {
    private $pdo;
    private $radovi = []; 

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function create() {
        for ($i = 2; $i <= 6; $i++) {
            $url = "https://stup.ferit.hr/index.php/zavrsni-radovi/page/$i/";
            $html = Scraper::fetchHTML($url);

            if ($html) {
                $this->radovi = array_merge($this->radovi, Scraper::parseHTML($html));
            }
        }
    }

    public function save() {
        $stmt = $this->pdo->prepare("INSERT INTO diplomski_radovi (naziv_rada, tekst_rada, link_rada, oib_tvrtke) VALUES (:naziv, :tekst, :link, :oib)");

        foreach ($this->radovi as $rad) {
            $stmt->execute([
                ':naziv' => $rad['naziv_rada'],
                ':tekst' => $rad['tekst_rada'],
                ':link' => $rad['link_rada'],
                ':oib' => $rad['oib_tvrtke']
            ]);
        }

        echo " Podaci su spremljeni u bazu!<br>";
    }

    public function read() {
        $stmt = $this->pdo->query("SELECT * FROM diplomski_radovi");
        $radovi = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($radovi as $rad) {
            echo " <b>Naziv rada:</b> {$rad['naziv_rada']} <br>";
            echo " <b>Link rada:</b> <a href='{$rad['link_rada']}'>{$rad['link_rada']}</a><br>";
            echo "<b>OIB tvrtke:</b> {$rad['oib_tvrtke']} <br>";
            echo "<hr>";
        }
    }
}