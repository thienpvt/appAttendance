<?php


    use App\Enums\UserRoleEnum;

    if (!function_exists('user')) {
        function user(): ?object
        {
            return auth()->user();
        }
    }

    if (!function_exists('isAdmin')) {
        function isAdmin(): bool
        {
            return user() && user()->level === UserRoleEnum::admin;
        }
    }

    if (!function_exists('isLecturer')) {
        function isLecturer(): bool
        {
            return user() && user()->level === UserRoleEnum::lecturer;
        }
    }
    if (!function_exists('getRole')) {
        function getRole(): string
        {
            return array_search(user()->level, UserRoleEnum::getRole(), true);
        }
    }
