<?php
class Usuario
{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;

    private $conexiondb;

    // Método constructor
    public function __construct()
    {
        $this->conexiondb = ConexionDB::connect();
    }


    // Métodos getter
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    // Métodos setter
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }


    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function save()
    {
        $nombre = $this->getNombre();
        $apellidos = $this->getApellidos();
        $email = $this->getEmail();
        $password = $this->getPassword();

        // Escapa los valores y hashea la contraseña
        $nombre = $this->conexiondb->real_escape_string($nombre);
        $apellidos = $this->conexiondb->real_escape_string($apellidos);
        $email = $this->conexiondb->real_escape_string($email);
        $password = password_hash($this->conexiondb->real_escape_string($password), PASSWORD_BCRYPT, ['cost' => 4]);

        // Crea la sentencia SQL con los valores
        $sql = "INSERT INTO usuarios VALUES(NULL, '$nombre', '$apellidos', '$email', '$password', 'user', NULL);";
        $save = $this->conexiondb->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function login()
    {       
        $email=$this->email;
        $password=$this->password;
        $result = false;
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->conexiondb->query($sql);
        if ($login && $login->num_rows == 1) {
            $usuario = $login->fetch_object();
            $verify = password_verify($password, $usuario->password);
            if ($verify) {
                $result = $usuario;
            }
        }
        return $result;
    }
}
