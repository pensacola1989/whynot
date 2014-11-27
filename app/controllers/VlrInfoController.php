<?php
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/26/14
 * Time: 1:37 AM
 */
use Hgy\VltField\VltAttributeRepository;

class VlrInfoController extends BaseController {

    private $fieldTypeMap = [
        'datetime'  =>  '日期类型',
        'text'      =>  '文本类型',
        'enum'      =>  '枚举类型',
        'email'     =>  'email类型',
        'textarea'   =>  '多文字',
        'image'     =>  '图片'
    ];

    protected $layout = 'layouts.home';

    private $VltAttRepo;

    public function __construct(VltAttributeRepository $vltAttributeRepository)
    {
        $this->VltAttRepo = $vltAttributeRepository;
    }

    public function index()
    {
        $this->title = '志愿者信息收集';
        $attrs = $this->VltAttRepo->getAttributeInfoByOrgAndOrder($this->getCurrentUser());
        $fieldTypeMap = $this->fieldTypeMap;
        $this->view('volunteer.info', compact('attrs','fieldTypeMap'));
    }

    /**
     * http post
     */
    public function postEdit($id=null)
    {
        $newModel = $this->VltAttRepo->getNew(Input::all());
        if(!$newModel->validate())
            return $this->redirectBack(['errors'    =>  $newModel->errors()]);
        if($id == null) {
            $this->getCurrentUser()->VltAttributes()->save($newModel);
            return $this->redirectAction('VlrInfoController@index');
        }
        $this->VltAttRepo->UpdateAttributeInfoById($id,Input::all());
//        $oldModel = $this->VltAttRepo->requireById($id);
//        $oldModel->update(Input::all());
//        $this->getCurrentUser()->VltAttributes()->where('id', '=', $id)->first()->update(Input::all());
//        $this->VltAttRepo->UpdateAttributeInfo($this->getCurrentUser(),$newModel);
        return $this->redirectAction('VlrInfoController@index');
    }
    /**
     * http get
     */
    public function addShow()
    {
//        $this->view('')
    }

    public function postDelete()
    {
        $id = Input::get('id');
        if($ret = $this->VltAttRepo->requireById($id)) {
            $ret->delete();
            return ['errorCode' =>  0, 'message'    =>  '删除成功'];
        }
    }

    public function editShow($id=null)
    {
        $fieldTypeMap = $this->fieldTypeMap;
        $viewType = $id == null ? 'add' : 'edit';
        $data = null;
        if($id != null) {
            $data = $this->VltAttRepo->requireById($id);
        }
        $this->view('volunteer.infoEdit',compact('data','viewType','fieldTypeMap'));
    }

    public function postUpdateSort()
    {
        // error 102 => 缺少参数
        $sortIdArr = Input::get('idSorts');
        if($sortIdArr == null)
            return ['errorCode' => 102, 'message' => '缺少参数'];
        $sortIdArr = json_decode($sortIdArr);
        $this->VltAttRepo->updateSortByIdSorts($this->getCurrentUser(),$sortIdArr);
        return ['errorCode' => 0, 'message' => '更新排序成功'];
    }
}