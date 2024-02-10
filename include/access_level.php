<?php

//=============================================

enum AccessLevel: int {
    case ANY = -1;
    case USER = 0;
    case MODERATOR = 1;
    case ADMIN = 2;
}

//=============================================