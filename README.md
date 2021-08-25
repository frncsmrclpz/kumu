## **You should register and login first and then use the token for Authorization token header**

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
# Sample Json Response
[
    {
        "Name": "atmos",
        "Login": "atmos",
        "Company": null,
        "Number of Followers": 1228,
        "Number of public repositories": 168,
        "Average No. of Followers per Repository": 7
    },
    {
        "Name": "bmizerany",
        "Login": "bmizerany",
        "Company": null,
        "Number of Followers": 1294,
        "Number of public repositories": 158,
        "Average No. of Followers per Repository": 8
    }
]



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
