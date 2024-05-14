<?php
// HW8 - Airport API   Oswaldo Flores

/**
 * class Airport
 * <p>This represents one airport. This class should have functions that get the private
 * fields of this class. I should be able to create a new instance of this class.</p>
 */
class Airport
{
    /**
     * @var int <p>An unique id.</p>
     */
    private int $airportId;

    /**
     * @var string <p>The name of the building or company.</p>
     */
    private string $name;

    /**
     * @var string <p>The name of a city.</p>
     */
    private string $city;

    /**
     * @var string <p>The name of a country.</p>
     */
    private string $country;

    /**
     * @var string <p>The type of operation.</p>
     */
    private string $type;

    /**
     * @var string <p>A 3 iata code. Can be empty</p>
     */
    private string $iata;

    /**
     * @var string <p>A 4 icao code. Can be empty.</p>
     */
    private string $icao;

    /**
     * Index location of id.
     */
    const ID_INDEX = 0;

    /**
     * Index location of name.
     */
    const NAME_INDEX = 1;

    /**
     * Index location of city.
     */
    const CITY_INDEX = 2;

    /**
     * Index location of country.
     */
    const COUNTRY_INDEX = 3;

    /**
     * Index location of type.
     */
    const TYPE_INDEX = 12;

    /**
     * Index location of the iata code.
     */
    const IATA_INDEX = 4;

    /**
     * Index location of the icao code.
     */
    const ICAO_INDEX = 5;

    /**
     * To create an instance of this class with a given id, name, city, country, type, iata, and
     * icao. I assume the given data will be valid.
     *
     * @param int|string $airportId <p>An unique id.</p>
     * @param string $name <p>The name of the building or company.</p>
     * @param string $city <p>The name of a city.</p>
     * @param string $country <p>The name of a country.</p>
     * @param string $type <p>The type of operation.</p>
     * @param string $iata <p>A 3 iata code. Can be empty</p>
     * @param string $icao <p>A 4 icao code. Can be empty.</p>
     */
    public function __construct(int|string $airportId, string $name, string $city, string $country,
                                string $type, string $iata, string $icao){
        $this->airportId = (int)$airportId;
        $this->name = $name;
        $this->city = $city;
        $this->country = $country;
        $this->type = $type;
        $this->iata = $iata;
        $this->icao = $icao;
    }

    /**
     * @return int - This class id.
     */
    public function getId(): int
    {
        return $this->airportId;
    }

    /**
     * @return string - This class name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string - This class city.
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string - This class country.
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string - This class type.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string - This class iata.
     */
    public function getIata(): string
    {
        return $this->iata;
    }

    /**
     * @return string - This class icao.
     */
    public function getIcao(): string
    {
        return $this->icao;
    }

    /**
     * This function should be static because I should not create an empty instance of this class to create
     * a new instance. It does not matter to me if the data I am getting contains empty strings.
     *
     * @param array $line <p>A line given by a file.</p>
     * @return Airport - An instance of this class.
     */
    public static function newInstance(array $line): Airport{
        return new Airport($line[Airport::ID_INDEX], $line[Airport::NAME_INDEX], $line[Airport::CITY_INDEX],
            $line[Airport::COUNTRY_INDEX], $line[Airport::TYPE_INDEX], $line[Airport::IATA_INDEX],
            $line[Airport::ICAO_INDEX]);
    }
}
