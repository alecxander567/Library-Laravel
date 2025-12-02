<?php

namespace App\Enums;

enum Genre: string
{
    case Fiction = 'fiction';
    case NonFiction = 'non_fiction';
    case Mystery = 'mystery';
    case Fantasy = 'fantasy';
    case ScienceFiction = 'science_fiction';
    case Biography = 'biography';
    case Romance = 'romance';
    case Horror = 'horror';
}
