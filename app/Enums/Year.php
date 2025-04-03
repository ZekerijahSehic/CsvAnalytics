<?php

namespace App\Enums;

/**
 * Enum Year
 */
enum Year: int
{
    case Y1995 = 1995;
    case Y1996 = 1996;
    case Y1997 = 1997;
    case Y1998 = 1998;
    case Y1999 = 1999;
    case Y2000 = 2000;
    case Y2001 = 2001;
    case Y2002 = 2002;
    case Y2003 = 2003;
    case Y2004 = 2004;
    case Y2005 = 2005;
    case Y2006 = 2006;
    case Y2007 = 2007;
    case Y2008 = 2008;
    case Y2009 = 2009;
    case Y2010 = 2010;
    case Y2011 = 2011;
    case Y2012 = 2012;
    case Y2013 = 2013;
    case Y2014 = 2014;
    case Y2015 = 2015;
    case Y2016 = 2016;
    case Y2017 = 2017;
    case Y2018 = 2018;
    case Y2019 = 2019;
    case Y2020 = 2020;

    public function toString(): string
    {
        return (string) $this->value;
    }
}
