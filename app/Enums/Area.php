<?php

namespace App\Enums;

/**
 * Enum Area
 */
enum Area: string
{
    case BARKING_AND_DAGENHAM = 'Barking and Dagenham';
    case BARNET = 'Barnet';
    case BEXLEY = 'Bexley';
    case BRENT = 'Brent';
    case BROMLEY = 'Bromley';
    case CAMDEN = 'Camden';
    case CITY_OF_LONDON = 'City of London';
    case CROYDON = 'Croydon';
    case EALING = 'Ealing';
    case EAST_MIDLANDS = 'East Midlands';
    case EAST_OF_ENGLAND = 'East of England';
    case ENFIELD = 'Enfield';
    case ENGLAND = 'England';
    case GREENWICH = 'Greenwich';
    case HACKNEY = 'Hackney';
    case HAMMERSMITH_AND_FULHAM = 'Hammersmith and Fulham';
    case HARINGEY = 'Haringey';
    case HARROW = 'Harrow';
    case HAVERING = 'Havering';
    case HILLINGDON = 'Hillingdon';
    case HOUNSLOW = 'Hounslow';
    case INNER_LONDON = 'Inner London';
    case ISLINGTON = 'Islington';
    case KENSINGTON_AND_CHELSEA = 'Kensington and Chelsea';
    case KINGSTON_UPON_THAMES = 'Kingston upon Thames';
    case LAMBETH = 'Lambeth';
    case LEWISHAM = 'Lewisham';
    case LONDON = 'London';
    case MERTON = 'Merton';
    case NEWHAM = 'Newham';
    case NORTH_EAST = 'North East';
    case NORTH_WEST = 'North West';
    case OUTER_LONDON = 'Outer London';
    case REDBRIDGE = 'Redbridge';
    case RICHMOND_UPON_THAMES = 'Richmond upon Thames';
    case SOUTH_EAST = 'South East';
    case SOUTH_WEST = 'South West';
    case SOUTHWARK = 'Southwark';
    case SUTTON = 'Sutton';
    case TOWER_HAMLETS = 'Tower Hamlets';
    case WALTHAM_FOREST = 'Waltham Forest';
    case WANDSWORTH = 'Wandsworth';
    case WEST_MIDLANDS = 'West Midlands';
    case WESTMINSTER = 'Westminster';
    case YORKS_AND_THE_HUMBER = 'Yorks and the Humber';

    public function toLowerLetters(): string
    {
        return strtolower($this->value);
    }
}
