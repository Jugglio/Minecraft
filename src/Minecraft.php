<?php

namespace Juggl\Minecraft;

class Minecraft
{
    /**
     * Get UUID from Minecraft username.
     *
     * @param  string $name      Username to be converted to UUID
     * @param  int    $timestamp UNIX timestamp (without miliseconds)
     * @return string            The player's UUID
     */
    public function getUuidFromName($name, $timestamp = null)
    {
        $url = 'https://api.mojang.com/users/profiles/minecraft/' . $name;

        if ($timestamp) {
            $url .= '?at=' . $timestamp;
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response)->id;
    }

    /**
     * Get all names the player has ever played as.
     *
     * @param  string $uuid UUID of the player.
     * @return array        All names player has played as.
     */
    public function getNameHistory($uuid)
    {
        $url = 'https://api.mojang.com/user/profiles/' . $uuid . '/names';

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    /**
     * [getNameFromUuid description]
     * @param  [type] $uuid [description]
     * @return [type]       [description]
     */
    public function getNameFromUuid($uuid)
    {
        $users = $this->getNameHistory($uuid);
        $user = end($users);

        return $user->name;
    }

    /**
     * Retrieves array of user objects.
     *
     * @param  array  $names     Usernames
     * @return array  $response  Player objects
     */
    public function getUuidsFromNames(array $names)
    {
        if (count($names) > 100) {
            return false;
        }

        $url = 'https://api.mojang.com/profiles/minecraft';

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($names),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
