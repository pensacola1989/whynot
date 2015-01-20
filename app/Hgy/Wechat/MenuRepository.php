<?php namespace Hgy\Wechat;
use Hgy\Core\EntityRepository;
use Illuminate\Support\Facades\Auth;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/20/15
 * Time: 3:45 PM
 */

class MenuRepository extends EntityRepository {

    /**
     * @var 当前的组织用户
     */
    private $currentUser;

    public function __construct(Menu $model)
    {
        $this->model = $model;
        $this->currentUser = Auth::user()->Orgs()->first();
    }

    public function saveMenu($JsonMenu)
    {
        // 如果已经存在，则更新
        if($this->currentUser->Menu == null) {
            $newObj = $this->getNew([
                'org_id'    =>  $this->currentUser->id,
                'menu_str'  =>  $JsonMenu
            ]);
            return $this->currentUser->Menu()->save($newObj);
        } else {
            return $this->currentUser->Menu()->update([
                'menu_str'  =>  $JsonMenu
            ]);
        }
    }

    public function getMenuByOrgUser()
    {
        return $this->currentUser->Menu;
    }
}