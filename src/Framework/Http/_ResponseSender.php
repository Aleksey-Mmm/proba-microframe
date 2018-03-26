<?php
/**
 * User: alexey
 * Date: 23.03.2018
 * Time: 10:16
 */
/*
namespace Framework\Http;

use Psr\Http\Message\ResponseInterface;

class ResponseSender
{
    /**
     * @param ResponseInterface $response
     */
/*
    public function send($response)
    {
        header(sprintf('HTTP/%s %d %s',
            $response->getProtocolVersion(),
            $response->getStatusCode(),
            $response->getReasonPhrase()));

        foreach ($response->getHeaders() as $name_r => $values) {
            foreach ($values as $value) {
                header(sprintf('%s %s', $name_r, $value), false);
            }
        }

        echo $response->getBody()->getContents();
    }
}*/