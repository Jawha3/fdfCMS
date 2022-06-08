<?php
# Script til håndtering af logout funktion

// Alle sessions varibler og selve sessionen bliver destrueret og brugeren bliver videresendt til loginsiden
session_start();
session_unset();
session_destroy();

header("Location: ../../index.php?=loggedOut");
exit();
