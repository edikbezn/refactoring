<?php


class FileReader
{
    protected string $path;

    /**
     * FileReader constructor.
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @return Generator
     */
    public function getLine(): Generator
    {
        $file = fopen($this->path,"r");

        if (!$file) {
            throw new RuntimeException('Error opening file');
        }

        while(! feof($file))
        {
            yield fgets($file);
        }
        fclose($file);
    }
}