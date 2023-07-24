<?php
namespace App\ClassicTrader\Http;

interface IRequest {
    public function getBody();
    public function getMethod(): string;
    public function getUri(): string;
    public function getHeaders(): array;
    public function getQueryParams(): array;
}