<?php

namespace pxgamer\XbtitToUnit3d\Functionality;

use Carbon\Carbon;
use Orchestra\Testbench\TestCase;

class MappingTest extends TestCase
{
    const TEST_DATE_STRING = '2017-10-15 06:06:06';
    const TEST_STRING = 'SpaghettiTest';
    const TEST_HASH = 'f87b9feb33b6744f0bd1cb53b6fc1f23';

    /**
     * Test that the ::map() method works with a User instance.
     */
    public function testMapUserIsSuccessful()
    {
        $data = new \stdClass();
        $data->username = self::TEST_STRING;
        $data->password = null;
        $data->pid = null;
        $data->id_level = 1;
        $data->email = null;
        $data->uploaded = 0;
        $data->downloaded = 0;
        $data->avatar = null;
        $data->joined = self::TEST_DATE_STRING;
        $data->lastconnect = self::TEST_DATE_STRING;

        $result = Mapping::map('User', $data);

        $this->assertInternalType('array', $result);
        $this->assertEquals(self::TEST_STRING, $result['username']);
        $this->assertNull($result['password']);
        $this->assertEquals(0, $result['uploaded']);
        $this->assertEquals(0, $result['downloaded']);
        $this->assertInstanceOf(Carbon::class, $result['created_at']);
    }

    /**
     * Test that the ::map() method works with a Torrent instance.
     */
    public function testMapTorrentIsSuccessful()
    {
        $data = new \stdClass();
        $data->info_hash = self::TEST_HASH;
        $data->filename = self::TEST_STRING;
        $data->size = 0;
        $data->announce_url = null;
        $data->comment = null;
        $data->seeds = 0;
        $data->leechers = 0;
        $data->data = self::TEST_DATE_STRING;
        $data->lastupdate = self::TEST_DATE_STRING;

        $result = Mapping::map('Torrent', $data);

        $this->assertInternalType('array', $result);
        $this->assertEquals(self::TEST_HASH, $result['info_hash']);
        $this->assertEquals(0, $result['size']);
        $this->assertNull($result['announce']);
        $this->assertInstanceOf(Carbon::class, $result['created_at']);
    }
}
