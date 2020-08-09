<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mtvs\EloquentHashids\HasHashid;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class Request
 *
 * @package App\Http\Requests
 */
abstract class Request extends FormRequest
{
    use HasHashid;

    /**
     * @var array
     */
    protected $urlParameters = [];

    /**
     * @var array
     */
    protected $decode = [];

    /**
     * @param null $keys
     *
     * @throws \Exception
     *
     * @return array
     */
    public function all($keys = null)
    {
        $requestData = parent::all($keys);

        $requestData = $this->mergeUrlParametersWithRequestData($requestData);

        $requestData = $this->decodeHashedIdsBeforeValidation($requestData);

        return $requestData;
    }

    /**
     * @param array $requestData
     *
     * @return array
     */
    private function mergeUrlParametersWithRequestData(Array $requestData)
    {
        if (isset($this->urlParameters) && !empty($this->urlParameters)) {
            foreach ($this->urlParameters as $param) {
                $requestData[$param] = $this->route($param);
            }
        }

        return $requestData;
    }

    /**
     * @param array $requestData
     *
     * @throws \Exception
     *
     * @return array
     */
    protected function decodeHashedIdsBeforeValidation(Array $requestData)
    {
        // the hash ID feature must be enabled to use this decoder feature.
        if (isset($this->decode) && !empty($this->decode)) {
            // iterate over each key (ID that needs to be decoded) and call keys locator to decode them
            foreach ($this->decode as $key) {
                $requestData = $this->locateAndDecodeIds($requestData, $key);
            }
        }

        return $requestData;
    }

    /**
     * @param $requestData
     * @param $key
     *
     * @throws \Exception
     *
     * @return array|mixed
     */
    private function locateAndDecodeIds($requestData, $key)
    {
        // split the key based on the "."
        $fields = explode('.', $key);
        // loop through all elements of the key.
        $transformedData = $this->processField($requestData, $fields);

        return $transformedData;
    }

    /**
     * @param $data
     * @param $keysTodo
     *
     * @throws \Exception
     *
     * @return array|mixed
     */
    private function processField($data, $keysTodo)
    {
        // check if there are no more fields to be processed
        if (empty($keysTodo)) {
            // there are no more keys left - so basically we need to decode this entry
            $decodedId = $this->decode($data);
            return $decodedId;
        }

        // take the first element from the field
        $field = array_shift($keysTodo);

        // is the current field an array?! we need to process it like crazy
        if ($field == '*') {
            //make sure field value is an array
            $data = is_array($data) ? $data : [$data];

            // process each field of the array (and go down one level!)
            $fields = $data;
            foreach ($fields as $key => $value) {
                $data[$key] = $this->processField($value, $keysTodo);
            }
            return $data;

        } else {
            // check if the key we are looking for does, in fact, really exist
            if (!array_key_exists($field, $data)) {
                return $data;
            }

            // go down one level
            $value        = $data[$field];
            $data[$field] = $this->processField($value, $keysTodo);
            return $data;
        }
    }

    /**
     * @param string $id
     * @param null   $parameter
     *
     * @throws \Exception
     *
     * @return array|mixed
     */
    public function decode($id, $parameter = null)
    {
        // check if passed as null, (could be an optional decodable variable)
        if (is_null($id) || strtolower($id) == 'null') {
            return $id;
        }

        // check if is a number, to throw exception, since hashed ID should not be a number
        if (is_numeric($id)) {
            throw new \Exception('Only Hashed ID\'s allowed'.(!is_null($parameter) ? " ($parameter)." : '.'));
        }

        // do the decoding if the ID looks like a hashed one
        return empty($this->decoder($id)) ? [] : $this->decoder($id)[0];
    }

    /**
     * @param $id
     *
     * @return \Hashids\Hashids
     */
    private function decoder($id)
    {
        return Hashids::decode($id);
    }
}
