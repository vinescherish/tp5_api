<?php

namespace app\api\controller;

use app\api\model\ShopCategories;
use app\api\model\Shops;
use think\Controller;
use think\Db;

class ShopController extends Controller
{
    /**
     * @api {any} /api/shop/index  店铺分类
     * @apiVersion 1.0.0
     * @apiName 方法
     * @apiGroup shop
     *
     * @apiDescription 获取所有店铺分类
     *
     */
    public function index()
    {
        //取出所有分类
        $cates = Db::name('shop_categories')->where('status', 1)->select();
        if ($cates) {
            return api_json(1, '获取成功', $cates);
        } else {
            return api_json(1, '获取失败');
        }

    }

    /**
     * @api {get} /api/shop/lists  商家店铺接口
     * @apiVersion 1.0.0
     * @apiName lists
     * @apiGroup shop
     *
     * @apiDescription  商家店铺接口
     *
     * @apiParam  {int} id="2"  商铺分类id
     *
     */
    public function lists()
    {
        //分类ID
        $cateId = request()->get('id');
        //取出当前分类下的所有店铺
        $shops = Db::name('shops')->where('shop_category_id', $cateId)->select();
        if ($shops) {
            return api_json(1, '获取成功', $shops);
        }
        return api_json(0, '还没有商家');

    }

    /**
     * @api {get} /api/shop/goods 店铺详情信息
     * @apiVersion 1.0.0
     * @apiName goods
     * @apiGroup shop
     *
     * @apiDescription 接口详细说明
     *
     * @apiParam  {int} id="6"  店铺ID
     *
     */
    public function goods()
    {
        $id = request()->get('id');

        //读出当前店铺下的分类
        $menuCates = Db::name('menu_categories')->where('shop_id', $id)->select();
        //循环分类读出所有菜品
        $goods = [];
        $cate = [];
        foreach ($menuCates as $menuCate) {
            $cate[] = $menuCate;
            $goods[$menuCate['name']] = Db::name('menuses')->where( 'category_id', $menuCate['id'])->select();
            $cate[] = $goods[$menuCate['name']];
        }
        if ($menuCates) {
            return api_json(1, '获取成功', $cate);
        }
       return api_json(0,'当前店铺未分类');
    }
}
