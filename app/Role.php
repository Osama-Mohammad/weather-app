<?php

namespace App;

enum Role: string {
    case User = 'user';
    case EventOrganizer = 'event_organizer';
    case Admin = 'admin';
}
