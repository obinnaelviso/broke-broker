<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ContactForm;

class MailingList extends Model
{
    public function contact_forms() {
    	return $this->hasMany(ContactForm::class);
    }
}
