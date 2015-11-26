<?php

namespace Trinity\AdminBundle\Twig;



class FakeExtension extends \Twig_Extension
{

//    protected $redis;
//    protected $doctrine;
//    const seen_flag = ';;seen';
//    const length = 6;
//
//
//    public function __construct($redis,$doctrine) {
//        $this->redis = $redis;
//        $this->doctrine = $doctrine;
//    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('getSidebarMsgs', array($this, 'getRedisMsgs')),
            new \Twig_SimpleFilter('json_decode', array($this, 'jsonDecode')),
        );
    }

    public function jsonDecode($json)
    {
        return json_decode($json,true);
    }

    public function getRedisMsgs()
    {
        return [[$out], [], [], 0];
    }
//
////        if(get_class($this->redis) === "Predis\Client" ){
////            return $this->singleRedis();
////        }
//
//        if (count($this->redis->getConnection()) < 2) {
//            return $this->singleRedis();
//        }
//
//        return $this->multipleRedis();
//    }
//
//    private function multipleRedis(){
//            //number of redis servers
//        $out = count($this->redis->getConnection());
//            //for each server node
//        foreach ($this->redis->getConnection() as $nodeConnection) {
////            $out = get_class($nodeConnection);
//            $out = $nodeConnection->getParameters();
//            $cmdSel = $this->redis->createCommand('SELECT',['1']);
//            $cmdSet = $this->redis->createCommand('SET',['1','2']);
//            $cmdSet2 = $this->redis->createCommand('SET',['x','2']);
//            $nodeConnection->executeCommand($cmdSet);
//            $nodeConnection->executeCommand($cmdSel);
//            $nodeConnection->executeCommand($cmdSet2);
//            $out = $nodeConnection->getParameters();
//
//
//        }
//
//        return [ [$out],[],[],0];
//
//    }
//
//    private function singleRedis(){
//        $em = $this->doctrine->getManager();
//        $rep = $em->getRepository('NecktieAppBundle:User');
//
//        $not_seen = 0;
//        $cursor =0;
//
////        $allkeys = [];
////
////        foreach ($this->redis->getConnection() as $nodeConnection) {
////            $nodeKeys = $nodeConnection->keys('*');
////            $allkeys = array_merge($allkeys, $nodeKeys);
////        }
//
//        $keys = $this->redis->keys('*');
//
//        if(!$keys){return [[],[],[],$not_seen];}
//        if(count($keys) == 1) {
//            $value = $this->redis->get($keys[0]);
//            if($this->seen($value)){
//                $value = substr($value,0,-self::length);
//            }else{
//                $this->redis->append($keys[$cursor],self::seen_flag);
//                $not_seen++;
//            }
//            list($id, $rand, $time) = explode("_", $keys[0]);
//            $userName = $rep->find($id)->getUsername();
//
//
//            return [[$value],[$userName],[$time],$not_seen];
//        }else{
//            $values = $this->redis->mget($keys);
//
//            foreach ($values as $value){
//                if($this->seen($value)){
//                    $values[$cursor] = substr($value,0,-self::length);
//                }else{
//                    $this->redis->append($keys[$cursor],self::seen_flag);
//                    $not_seen++;
//                }
//                $cursor++;
//            }
//
//            $times = [];
//            $userNames = [];
//            $time_indexes = [];
//            $index=1;
//            $i=0;
//            foreach($keys as $key) {
//                $i++;
//                list($id, $rand, $time) = explode("_", $key);
//                $userName = $rep->find($id)->getUserName();
//                $time_index=$time.$index;
//                $index++;
//                array_push($userNames,$userName);
//                array_push($time_indexes,$time_index);
//                array_push($times,$time);
//            }
//
//
//            $list1 = array_combine($time_indexes,$values);
//            $list2 = array_combine($time_indexes,$userNames);
//
//
//            krsort($list1);
//            krsort($list2);
//            rsort($times);
//
//
//            return [array_values($list1),array_values($list2),$times,$not_seen];
//        }
//
//
//    }
//
//    private function seen($str){
//        return (substr($str, -self::length) === self::seen_flag);
//    }


    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'redis_extension';
    }
}