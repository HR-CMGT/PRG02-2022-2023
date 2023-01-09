<?php namespace MusicCollection\Utils;

/**
 * Class Session
 * @package MusicCollection\Utils
 */
class Session
{
    /**
     * Initialize object
     */
    public function __construct(private array $data)
    {
    }

    /**
     * Check if a var exists in the current session state
     *
     * @param string $var
     * @return bool
     */
    public function keyExists(string $var): bool
    {
        return array_key_exists($var, $this->data);
    }

    /**
     * Retrieve a var from the session array
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->data[$key];
    }

    /**
     * Set a var from in the global session
     *
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, mixed $value): void
    {
        $this->data[$key] = $value;
        $_SESSION[$key] = $value;
    }

    /**
     * Delete a var from the global session
     *
     * @param $key
     */
    public function delete(string $key): void
    {
        unset($this->data[$key]);
        unset($_SESSION[$key]);
    }

    /**
     * Destroy the session
     */
    public function destroy(): void
    {
        $this->data = [];
        session_destroy();
    }
}
