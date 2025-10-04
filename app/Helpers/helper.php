<?php

function getOrganizers()
{
    return \App\Models\User::where('role','organizer')->get();
}
