<?php

class Lottery
{
    const NUMBER_MIN = 1;
    const NUMBER_MAX = 60;

    const TOTAL_NUMBERS_MIN = 6;
    const TOTAL_NUMBERS_MAX = 10;

    private $result;
    private $games;
    private $totalGames;
    private $totalNumbers;

    public function __construct(int $totalNumbers, int $totalGames)
    {
        try {
            $this->setTotalNumbers($totalNumbers); // validate and set
            $this->totalGames = $totalGames;
            $this->games = [];
            $this->result = [];
        } catch(\Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    /**
     * @return array
     */
    private function generateRandomGame() : array
    {
        $numbers = [];

        while (count($numbers) < $this->totalNumbers) {
            $randomNumber = mt_rand(self::NUMBER_MIN, self::NUMBER_MAX);
            $numbers[$randomNumber] = $randomNumber;
        }

        sort($numbers);

        return $numbers;
    }

    /**
     *
     */
    public function generateGames() : void
    {
        for ($g = 0; $g < $this->totalGames; $g++) {
            $this->games[] = $this->generateRandomGame();
        }
    }

    /**
     *
     */
    public function generateResult() : void
    {
        $this->result = $this->generateRandomGame();
    }

    /**
     * @return string
     */
    public function showResult() : string
    {
        $htmlTable = '<table><tbody><tr>';

        foreach ($this->result as $number) {
            $htmlTable .=  '<td>' . str_pad($number, 2, '0', STR_PAD_LEFT) . '</td>';
        }

        $htmlTable .= '</tr></tbody></table>';

        return $htmlTable;
    }

    /**
     * @return string
     */
    public function showCheckedGames() : string
    {
        $htmlTable = '<table><tbody>';


        foreach ($this->games as $game) {
            $points = 0;
            $htmlTable .= '<tr>';
            foreach ($game as $number) {
                $numberClass = '';
                if (in_array($number, $this->result)) {
                    $numberClass = 'success';
                    $points++;
                }
                $htmlTable .=  '<td class="' . $numberClass. '">' . str_pad($number, 2, '0', STR_PAD_LEFT) . '</td>';
            }
            $htmlTable .=  '<th><strong>' . $points . ' acerto' . (($points > 1) ? 's' : '') . '</th>';
            $htmlTable .= '</tr>';
        }

        $htmlTable .= '</tbody></table>';

        return $htmlTable;
    }

    /**
     * @return array
     */
    public function getResult() : array
    {
        return $this->result;
    }

    /**
     * @param array $result
     */
    public function setResult(array $result) : void
    {
        $this->result = $result;
    }

    /**
     * @return array
     */
    public function getGames() : array
    {
        return $this->games;
    }

    /**
     * @param array $games
     */
    public function setGames(array $games) : void
    {
        $this->games = $games;
    }

    /**
     * @return int
     */
    public function getTotalGames() : int
    {
        return $this->totalGames;
    }

    /**
     * @param int $totalGames
     */
    public function setTotalGames(int $totalGames) : void
    {
        $this->totalGames = $totalGames;
    }

    /**
     * @return int
     */
    public function getTotalNumbers() : int
    {
        return $this->totalNumbers;
    }

    /**
     * @param int $totalNumbers
     * @throws Exception
     */
    public function setTotalNumbers(int $totalNumbers) : void
    {
        if ($totalNumbers < self::TOTAL_NUMBERS_MIN) {
            throw new \Exception('Total numbers must be equal to or greather than ' . self::TOTAL_NUMBERS_MIN);
        }

        if ($totalNumbers > self::TOTAL_NUMBERS_MAX) {
            throw new \Exception('Total numbers must be equal to or lower than ' . self::TOTAL_NUMBERS_MAX);
        }

        $this->totalNumbers = $totalNumbers;
    }
}