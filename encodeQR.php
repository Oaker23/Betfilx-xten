<?php
$text = "00020101021230680016A000000677010112011501075360001028602150140000046768540306REF1005802TH5409100000.00530376462200716000000000068027963041A3B";
$pattern = ["00020101021230", "00", "01", "02", "03", "58", "54", "53", "62", "07", "63"];
$part = [];

if (substr($text, 0, 14) == $pattern[0]) {
    $currentlenght = substr($text, 14, 2);
    $text = substr($text, 16);
    $currentpart = substr($text, 0, $currentlenght);
    $text = substr($text, $currentlenght);
    if (strlen($currentpart) == $currentlenght && substr($text, 0, 2) == $pattern[5]) {
        $part[0]["id"] = 0;
        $part[0]["pattern"] = $pattern[0];
        $part[0]["lenght"] = $currentlenght;
        $part[0]["string"] = $currentpart;
        $part[0]["success"] = true;
        $part[0]["text"] = $text;
    } else {
        $part[0]["success"] = "Missing Current Part 0";
    }
} else {
    $part[0]["success"] = "Missing Part 0";
}

if ($part[0]["success"]) {
    if (substr($part[0]["string"], 0, 2) == $pattern[1]) {
        $currentlenght = substr($part[0]["string"], 2, 2);
        $currenttext = substr($part[0]["string"], 4);
        $currentpart = substr($currenttext, 0, $currentlenght);
        $currenttext = substr($currenttext, $currentlenght);
        if (strlen($currentpart) == $currentlenght && substr($currenttext, 0, 2) == $pattern[2]) {
            $part[1]["id"] = 1;
            $part[1]["pattern"] = $pattern[1];
            $part[1]["lenght"] = $currentlenght;
            $part[1]["string"] = $currentpart;
            $part[1]["success"] = true;
            $part[1]["text"] = $currenttext;
        } else {
            $part[1]["success"] = "Missing Current Part 1";
        }
    } else {
        $part[1]["success"] = "Missing Part 1";
    }
} else {
    $part[1]["success"] = "Error Part 1";
}

if ($part[1]["success"]) {
    if (substr($part[1]["text"], 0, 2) == $pattern[2]) {
        $currentlenght = substr($part[1]["text"], 2, 2);
        $currenttext = substr($part[1]["text"], 4);
        $currentpart = substr($currenttext, 0, $currentlenght);
        $currenttext = substr($currenttext, $currentlenght);
        if (strlen($currentpart) == $currentlenght && substr($currenttext, 0, 2) == $pattern[3]) {
            $part[2]["id"] = 2;
            $part[2]["pattern"] = $pattern[2];
            $part[2]["lenght"] = $currentlenght;
            $part[2]["string"] = $currentpart;
            $part[2]["success"] = true;
            $part[2]["text"] = $currenttext;
        } else {
            $part[2]["success"] = "Missing Current Part 2";
        }
    } else {
        $part[2]["success"] = "Missing Part 2";
    }
} else {
    $part[2]["success"] = "Error Part 2";
}

if ($part[2]["success"]) {
    if (substr($part[2]["text"], 0, 2) == $pattern[3]) {
        $currentlenght = substr($part[2]["text"], 2, 2);
        $currenttext = substr($part[2]["text"], 4);
        $currentpart = substr($currenttext, 0, $currentlenght);
        $currenttext = substr($currenttext, $currentlenght);
        if (strlen($currentpart) == $currentlenght && substr($currenttext, 0, 2) == $pattern[4]) {
            $part[3]["id"] = 3;
            $part[3]["pattern"] = $pattern[3];
            $part[3]["lenght"] = $currentlenght;
            $part[3]["string"] = $currentpart;
            $part[3]["success"] = true;
            $part[3]["text"] = $currenttext;
        } else {
            $part[3]["success"] = "Missing Current Part 3";
        }
    } else {
        $part[3]["success"] = "Missing Part 3";
    }
} else {
    $part[3]["success"] = "Error Part 3";
}

if ($part[3]["success"]) {
    if (substr($part[3]["text"], 0, 2) == $pattern[4]) {
        $currentlenght = substr($part[3]["text"], 2, 2);
        $currenttext = substr($part[3]["text"], 4);
        $currentpart = substr($currenttext, 0, $currentlenght);
        $currenttext = substr($currenttext, $currentlenght);
        if (strlen($currentpart) == $currentlenght) {
            $part[4]["id"] = 4;
            $part[4]["pattern"] = $pattern[4];
            $part[4]["lenght"] = $currentlenght;
            $part[4]["string"] = $currentpart;
            $part[4]["success"] = true;
            $part[4]["text"] = $currenttext;
        } else {
            $part[4]["success"] = "Missing Current Part 4";
        }
    } else {
        $part[4]["success"] = "Missing Part 4";
    }
} else {
    $part[4]["success"] = "Error Part 4";
}

if ($part[4]["success"]) {
    if (substr($part[0]["text"], 0, 2) == $pattern[5]) {
        $currentlenght = substr($part[0]["text"], 2, 2);
        $currenttext = substr($part[0]["text"], 4);
        $currentpart = substr($currenttext, 0, $currentlenght);
        $currenttext = substr($currenttext, $currentlenght);
        if (strlen($currentpart) == $currentlenght && substr($currenttext, 0, 2) == $pattern[6]) {
            $part[5]["id"] = 5;
            $part[5]["pattern"] = $pattern[5];
            $part[5]["lenght"] = $currentlenght;
            $part[5]["string"] = $currentpart;
            $part[5]["success"] = true;
            $part[5]["text"] = $currenttext;
        } else {
            $part[5]["success"] = "Missing Current Part 5";
        }
    } else {
        $part[5]["success"] = "Missing Part 5";
    }
} else {
    $part[5]["success"] = "Error Part 5";
}

if ($part[5]["success"]) {
    if (substr($part[5]["text"], 0, 2) == $pattern[6]) {
        $currentlenght = substr($part[5]["text"], 2, 2);
        $currenttext = substr($part[5]["text"], 4);
        $currentpart = substr($currenttext, 0, $currentlenght);
        $currenttext = substr($currenttext, $currentlenght);
        if (strlen($currentpart) == $currentlenght && substr($currenttext, 0, 2) == $pattern[7]) {
            $part[6]["id"] = 6;
            $part[6]["pattern"] = $pattern[6];
            $part[6]["lenght"] = $currentlenght;
            $part[6]["string"] = $currentpart;
            $part[6]["success"] = true;
            $part[6]["text"] = $currenttext;
        } else {
            $part[6]["success"] = "Missing Current Part 6";
        }
    } else {
        $part[6]["success"] = "Missing Part 6";
    }
} else {
    $part[6]["success"] = "Error Part 6";
}

if ($part[6]["success"]) {
    if (substr($part[6]["text"], 0, 2) == $pattern[7]) {
        $currentlenght = substr($part[6]["text"], 2, 2);
        $currenttext = substr($part[6]["text"], 4);
        $currentpart = substr($currenttext, 0, $currentlenght);
        $currenttext = substr($currenttext, $currentlenght);
        if (strlen($currentpart) == $currentlenght && substr($currenttext, 0, 2) == $pattern[8]) {
            $part[7]["id"] = 7;
            $part[7]["pattern"] = $pattern[7];
            $part[7]["lenght"] = $currentlenght;
            $part[7]["string"] = $currentpart;
            $part[7]["success"] = true;
            $part[7]["text"] = $currenttext;
        } else {
            $part[7]["success"] = "Missing Current Part 7";
        }
    } else {
        $part[7]["success"] = "Missing Part 7";
    }
} else {
    $part[7]["success"] = "Error Part 7";
}

if ($part[7]["success"]) {
    if (substr($part[7]["text"], 0, 2) == $pattern[8]) {
        $currentlenght = substr($part[7]["text"], 2, 2);
        $currenttext = substr($part[7]["text"], 4);
        $currentpart = substr($currenttext, 0, $currentlenght);
        $currenttext = substr($currenttext, $currentlenght);
        if (strlen($currentpart) == $currentlenght) {
            $part[8]["id"] = 8;
            $part[8]["pattern"] = $pattern[8];
            $part[8]["lenght"] = $currentlenght;
            $part[8]["string"] = $currentpart;
            $part[8]["success"] = true;
            $part[8]["text"] = $currenttext;
        } else {
            $part[8]["success"] = "Missing Current Part 8";
        }
    } else {
        $part[8]["success"] = "Missing Part 8";
    }
} else {
    $part[8]["success"] = "Error Part 8";
}

if ($part[8]["success"]) {
    if (substr($part[8]["string"], 0, 2) == $pattern[9]) {
        $currentlenght = substr($part[8]["string"], 2, 2);
        $currenttext = substr($part[8]["string"], 4);
        $currentpart = substr($currenttext, 0, $currentlenght);
        $currenttext = substr($currenttext, $currentlenght);
        if (strlen($currentpart) == $currentlenght) {
            $part[9]["id"] = 9;
            $part[9]["pattern"] = $pattern[9];
            $part[9]["lenght"] = $currentlenght;
            $part[9]["string"] = $currentpart;
            $part[9]["success"] = true;
            $part[9]["text"] = $currenttext;
        } else {
            $part[9]["success"] = "Missing Current Part 9";
        }
    } else {
        $part[9]["success"] = "Missing Part 9";
    }
} else {
    $part[9]["success"] = "Error Part 9";
}

if ($part[9]["success"]) {
    if (substr($part[8]["text"], 0, 2) == $pattern[10]) {
        $currentlenght = substr($part[8]["text"], 2, 2);
        $currenttext = substr($part[8]["text"], 4);
        $currentpart = substr($currenttext, 0, $currentlenght);
        $currenttext = substr($currenttext, $currentlenght);
        if (strlen($currentpart) == $currentlenght) {
            $part[10]["id"] = 10;
            $part[10]["pattern"] = $pattern[8];
            $part[10]["lenght"] = $currentlenght;
            $part[10]["string"] = $currentpart;
            $part[10]["success"] = true;
            $part[10]["text"] = $currenttext;
        } else {
            $part[10]["success"] = "Missing Current Part 10";
        }
    } else {
        $part[10]["success"] = "Missing Part 10";
    }
} else {
    $part[10]["success"] = "Error Part 10";
}

echo '$aid = "' . $part[1]["string"] . '";<br>
$billerid = "' . $part[2]["string"] . '";<br>
$ref1 = "' . $part[3]["string"] . '";<br>
$currency = "' . $part[7]["string"] . '";<br>
$country = "' . $part[5]["string"] . '";<br>
$addlenght = "' . $part[8]["lenght"] . '";<br>
$terminalid = "' . $part[9]["string"] . '";<br>';
