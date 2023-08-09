<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    User\ValueObject  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User\ValueObject;

use DateTime;

/**
 * Data class
 *
 * @package User\ValueObject
 */
class Data
{
    /**
     * Possible countries of user for this web application.
     * 
     * @const array
     */
    const COUNTRIES = [
        'DE' => 'Deutschland',
        'AT' => 'Österreich',
        'CH' => 'Schweiz',
    
    
            /*                                   
        'AL' => 'Albanien',
        'DZ' => 'Algerien',
        'AS' => 'Amerikanisch-Samoa',
        'AD' => 'Andorra',
        'AO' ='244'>Angola
        'AF' ='93'>Afghanistan
        'AI' ='809'>Anguilla
        'AQ' ='672'>Antarktis
        'AG' ='268'>Antigua und Barbuda
        'AR' ='54'>Argentinien
        'AM' ='374'>Armenien
        'AW' ='297'>Aruba
        'AC' ='247'>Ascension
        'AU' ='61'>Australien
        'AT' ='43'>Österreich
        'AZ' ='994'>Aserbaidschan
        'BS' ='242'>Bahamas
        'BH' ='973'>Bahrain
        'BD' ='880'>Bangladesch
        'BB' ='246'>Barbados
        'BY' ='375'>Weißrussland
        'BE' ='32'>Belgien
        'BZ' ='501'>Belize
        'BJ' ='229'>Benin
        'BM' ='809'>Bermuda
        'BT' ='975'>Bhutan
        'BO' ='591'>Bolivien
        'BA' ='387'>Bosnien und Herzegowina
        'BW' ='267'>Botswana
        'BV' =''>Bouvetinsel
        'BR' ='55'>Brasilien
        'BQ' =''>Bonaire, Saint Eustatius und Saba
        'IO' =''>Britisches Territorium im Indischen Ozean
        'VG' ='284'>Britische Jungferninseln
        'BN' ='673'>Brunei
        'BG' ='359'>Bulgarien
        'BF' ='226'>Burkina Faso
        'BI' ='257'>Burundi
        'KH' ='855'>Kambodscha
        'CM' ='237'>Kamerun
        'CA' ='1'>Kanada
        'IC' =''>Kanarische Inseln
        'CT' =''>Kanton- und Enderbury-Insel
        'CV' ='238'>Kapverdische Inseln
        'KY' ='345'>Cayman-Inseln
        'CF' ='236'>Zentralafrikanische Republik
        'EA' =''>Ceuta und Melilla
        'TD' ='235'>Tschad
        'CL' ='56'>Chile
        'CN' ='86'>China
        'CX' ='61'>Weihnachtsinseln
        'CP' =''>Clipperton-Insel
        'CC' ='61'>Cocos- [Keeling-] Inseln
        'CO' ='57'>Kolumbien
        'KM' ='269'>Komoren
        'CD' ='242'>Kongo [Demokratische Republik Kongo]
        'CK' ='682'>Cookinseln
        'CR' ='506'>Costa Rica
        'HR' ='385'>Kroatien
        'CY' ='357'>Zypern
        'CZ' ='420'>Tschechische Republik
        'DK' ='45'>Dänemark
        'DG' ='246'>Diego Garcia
        'DJ' ='253'>Dschibuti
        'DM' ='767'>Dominica
        'DO' ='809'>Dominikanische Republik
        'NQ' =''>Königin-Maud-Land
        'TL' ='670'>Timor-Leste
        'EC' ='593'>Ecuador
        'EG' ='20'>Ägypten
        'SV' ='503'>El Salvador
        'ER' =''>Eritrea
        'EE' ='372'>Estland
        'ET' ='251'>Äthiopien
        'EU' =''>Europäische Union
        'FK' ='500'>Falkland-Inseln [Islas Malvinas]
        'FO' ='298'>Färöischen Inseln
        'FJ' ='679'>Fidschi
        'FI' ='358'>Finnland
        'FR' ='33'>Frankreich
        'GF' ='594'>Französisch-Guayana
        'PF' ='689'>Französisch-Polynesien
        'TF' =''>Französische Südgebiete
        'FQ' =''>Französische Süd- und Antarktisgebiete
        'GA' ='241'>Gabun
        'GM' ='220'>Gambia
        'GE' ='995'>Georgien
        'DE' ='49'>Deutschland
        'GH' ='233'>Ghana
        'GI' ='350'>Gibraltar
        'GR' ='30'>Griechenland
        'GL' ='299'>Grönland
        'GD' ='473'>Grenada
        'GP' =''>Guadeloupe
        'GU' ='671'>Guam
        'GT' ='502'>Guatemala
        'GN' =''>Guinea
        'GW' ='245'>Guinea-Bissau
        'GY' ='592'>Guyana
        'HT' ='509'>Haiti
        'HM' =''>Heard und McDonaldinseln
        'VA' ='39'>Vatikanstadt
        'HN' ='504'>Honduras
        'HK' ='852'>Hong Kong, China
        'HU' ='36'>Ungarn
        'IS' ='354'>Island
        'IN' ='91'>Indien
        'ID' ='62'>Indonesien
        'IE' ='353'>Irland
        'IM' ='44'>Isle of Man
        'IL' ='972'>Israel
        'IQ' ='964'>Irak
        'IT' ='39'>Italien
        'JM' ='876'>Jamaica
        'JP' ='81'>Japan
        'JT' =''>Johnston-Inseln
        'JO' ='962'>Jordanien
        'KZ' ='7'>Kasachstan
        'KE' ='254'>Kenia
        'KI' ='686'>Kiribati
        'KW' ='965'>Kuwait
        'KG' ='996'>Kirgisistan
        'LA' ='856'>Laos
        'LV' ='371'>Lettland
        'LB' =''>Libanon
        'LS' ='266'>Lesotho
        'LY' ='218'>Libyen
        'LI' ='423'>Liechtenstein
        'LT' ='370'>Litauen
        'LU' ='352'>Luxemburg
        'MO' ='853'>Macau, China
        'MK' ='389'>Mazedonien [EJRM]
        'MG' ='261'>Madagaskar
        'MW' ='265'>Malawi
        'MY' ='60'>Malaysia
        'MV' ='960'>Malediven
        'ML' ='223'>Mali
        'MT' ='356'>Malta
        'MH' ='692'>Marschallinseln
        'MQ' ='596'>Martinique
        'MR' ='222'>Mauretanien
        'MU' ='230'>Mauritius
        'YT' ='269'>Mayotte
        'FX' =''>Metropolitan-Frankreich
        'MX' ='52'>Mexiko
        'FM' ='691'>Mikronesien
        'MI' =''>Midwayinseln
        'MD' ='373'>Moldawien
        'MC' ='33'>Monaco
        'MN' ='976'>Mongolei
        'ME' ='382'>Montenegro
        'MS' ='473'>Montserrat
        'MA' ='212'>Marokko
        'MZ' ='258'>Mosambik
        'MM' ='95'>Myanmar
        'NA' ='264'>Namibia
        'NR' ='674'>Nauru
        'NP' ='977'>Nepal
        'NL' ='31'>Niederlande
        'AN' ='599'>Niederländische Antillen
        'NT' =''>Neutrale Zone
        'NC' ='687'>Neukaledonien
        'NZ' ='64'>Neuseeland
        'NI' ='505'>Nicaragua
        'NE' ='227'>Niger
        'NG' ='234'>Nigeria
        'NU' ='683'>Niue
        'NF' =''>Norfolkinsel
        'VD' =''>Nordvietnam
        'MP' ='1'>Nördliche Marianen
        'NO' ='47'>Norwegen
        'OM' ='968'>Oman
        'QO' =''>Outlying Islands von Ozeanien
        'PC' =''>Treuhandgebiet Pazifische Inseln
        'PK' ='92'>Pakistan
        'PW' ='680'>Palau
        'PS' =''>Palästinensische Gebiete
        'PA' ='507'>Panama
        'PZ' =''>Panamakanalzone
        'PY' ='595'>Paraguay
        'YD' =''>Demokratische Volksrepublik Jemen
        'PE' ='51'>Peru
        'PH' ='63'>Philippinen
        'PN' ='870'>Pitcairninseln
        'PL' ='48'>Polen
        'PT' ='351'>Portugal
        'PR' ='1'>Puerto Rico
        'QA' ='974'>Katar
        'RO' ='40'>Rumänien
        'RU' ='7'>Russland
        'RW' ='250'>Ruanda
        'RE' ='262'>Reunion
        'BL' ='590'>St. Bartholomäus
        'SH' ='290'>St. Helena
        'KN' ='869'>St. Kitts und Nevis
        'LC' ='1'>St. Lucia
        'MF' ='1'>St. Martin
        'PM' ='508'>St. Pierre und Miquelon
        'VC' ='1'>St. Vincent und die Grenadinen
        'WS' ='685'>Samoa
        'SM' ='378'>San Marino
        'SA' ='966'>Saudi-Arabien
        'SN' ='221'>Senegal
        'RS' ='381'>Serbien
        'CS' ='381'>Serbien und Montenegro
        'SC' ='248'>Seychellen
        'SL' ='232'>Sierra Leone
        'SG' ='65'>Singapur
        'SK' ='421'>Slowakei
        'SI' ='386'>Slowenien
        'SB' ='677'>Salomonen
        'SO' ='252'>Somalia
        'ZA' ='27'>Südafrika
        'GS' =''>Südgeorgien und die Südlichen Sandwichinseln
        'KR' ='82'>Südkorea
        'SS' =''>Südsudan
        'ES' ='34'>Spanien
        'LK' ='94'>Sri Lanka

            'SD'>Sudan
        'SR' ='597'>Suriname
        'SJ' =''>Svalbard und Jan Mayen
        'SZ' ='268'>Swasiland
        'SE' ='46'>Schweden
        'CH' ='41'>Schweiz
        'ST' ='239'>Sao Tome und Principe
        'TW' ='886'>Taiwan, China
        'TJ' ='992'>Tadschikistan
        'TZ' ='255'>Tansania
        'TH' ='66'>Thailand
        'TG' ='228'>Togo
        'TK' ='690'>Tokelau
        'TO' ='676'>Tonga
        'TT' ='1'>Trinidad und Tobago
        'TA' =''>Tristan da Cunha
        'TN' ='216'>Tunesien
        'TR' ='90'>Türkei
        'TM' ='993'>Turkmenistan
        'TC' ='1'>Turks- und Caicosinseln
        'TV' ='688'>Tuvalu
        'UM' =''>United States Minor Outlying Islands
        'PU' =''>U.S. Miscellaneous Pacific Islands
        'VI' ='1'>Amerikanische Jungferninseln
        'UG' ='256'>Uganda
        'UA' ='380'>Ukraine
        'AE' ='971'>Vereinigte Arabische Emirate
        'GB' ='44'>Vereinigtes Königreich Großbritannien und Nordirland
        'US' ='1'>Vereinigte Staaten von Amerika
        'UY' ='598'>Uruguay
        'UZ' ='998'>Usbekistan
        'VU' ='678'>Vanuatu
        'VA' ='39'>Vatikanstadt
        'VE' ='58'>Venezuela
        'VN' ='84'>Vietnam
        'WK' =''>Wake-Insel
        'WF' ='681'>Wallis und Futuna
        'EH' =''>Westsahara
        'YE' ='967'>Jemen
        'ZM' ='260'>Sambia
        'ZW' ='263'>Zimbabwe
             * 
             */
    ];
                                            
    /**
     * User alias min length
     * 
     * @const integer
     */
    const ALIAS_MIN_LENGTH = 3;
    
    /**
     * User alias max length
     * 
     * @const integer
     */
    const ALIAS_MAX_LENGTH = 64;

    /**
     * User password min length
     * 
     * @const integer
     */
    const PASSWORD_MIN_LENGTH = 6;
    
    /**
     * User password max length
     * 
     * @const integer
     */
    const PASSWORD_MAX_LENGTH = 64;
    
    /**
     * Paginator Number of entries per page
     * 
     * @const integer
     */
    const PAGINATOR_CONT_PER_PAGE = 3;
    
    /**
     * Paginator page range
     * 
     * Number of pages displayed in the pagination navigation.
     * 
     * @const integer
     */
    const PAGINATOR_PAGE_RANGE = 4;
    
    /**
     * Name of the users db table
     * 
     * @const string
     */
    const USERS_DB_TABLE_NAME = 'user_users';
    
    /**
     * Name of the securitytokens db table
     * 
     * @const string
     */
    const SECURITYTOKENS_DB_TABLE_NAME = 'user_securitytokens';

    /**
     * With DateTime you can make the shortest date&time validator for all formats.
     * 
     * https://www.php.net/manual/de/function.checkdate.php
     * 
     * @param string $date
     * @param string $format
     * @return boolean
     */
    static function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        
        return $d && $d->format($format) == $date;
    }
}
