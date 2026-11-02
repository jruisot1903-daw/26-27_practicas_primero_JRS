<?php

enum EstadoCivil: int {
    case soltero = 10;
    case pareja = 20;
    case casado = 30;
    case viudo = 40;

    public function descripcion(): string {
        return match($this) {
            self::soltero => 'soltero',
            self::pareja => 'pareja',
            self::casado => 'casado',
            self::viudo => 'viudo',
        };
    }

   public function valor(): string {
        return match($this) {
            self::soltero => 10,
            self::pareja => 20,
            self::casado => 30,
            self::viudo => 40,
        };
    }

   public static function casos(): array {
        return self::cases();
    }

}