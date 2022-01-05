<?php
class Paedagoge
{
    public int $id;
    public string $email;
    public string $passwort;
    public bool $admin;
    public string $vorname;
    public string $nachname;

    public function __construct(int $id, string $email,string $passwort, bool $admin, string $vorname, string $nachname)
    {
        $this->id = $id;
        $this->email = $email;
        $this->passwort = $passwort;
        $this->admin = $admin;
        $this->vorname = $vorname;
        $this->nachname = $nachname;
    }

}
