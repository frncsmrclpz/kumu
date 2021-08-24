CHALLENGE #1

Endpoints:
Api URL: http://<localhost>:port
/api/register
/api/login

# for data output
/api/kumu
# Sample Json Body
{
    "user": "test1",
    "usernames": [
        "mojombo1",
        "pjhyett",
        "wycats",
        "bmizerany",
        "mojodna",
        "errfree",
        "atmos",
        "jamesgolick",
        "kirinDave",
        "kevwil",
        "nitay"
    ]
}



CHALLENGE #2

function hammingDistance($n1, $n2)
{
    $x = $n1 ^ $n2;
    $setBits = 0;
 
    while ($x > 0)
    {
        $setBits += $x & 1;
        $x >>= 1;
    }
 
    return $setBits;
}
