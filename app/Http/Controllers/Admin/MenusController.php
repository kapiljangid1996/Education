<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuPage;

class MenusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->menuTabs = array('custom-links'=>'Custom Links');
    }

   	public function index()
    {
        $menus = Menu::OrderBy('created_at','DESC')->get();
        return view('admin.menu.index')->with('menus', $menus);
    }

   	public function create()
    {
        return view('admin.menu.add');
    }

    public function store(Request $request)
    {        
        $menus = Menu::storeMenu($request);
        return redirect()->route('menu.index')->with('success','Menu Created!');
    }

    public function edit($id)
    {
        $menus = Menu::find($id);
        return view('admin.menu.edit')->with('menus',$menus);
    }

    public function update(Request $request, $id)
    {   
        $menus = Menu::editMenu($request,$id);
        return redirect()->route('menu.index')->with('success','Menu Updated!');
    }

    public function destroy($id)
    {
        $menus = Menu::findOrFail($id);
        $menus->delete();
        return redirect()->route('menu.index')->with('success','Menu Deleted!');
    }

    public function manageMenuPage($menu_id)
    {
        $menu_types = Menu::where('status',1)->get();
        $menuDetail = Menu::find($menu_id);
        $records = MenuPage::where('menu_id',$menu_id)->OrderBy('sort_number','ASC')->get();
        $menusList = $this->getMenusList($menu_id);
        $menus = !empty($menusList) ? json_encode(array_values($menusList)) : '';
        return view('admin.menu.manage_menu',['menuTabs'=>$this->menuTabs])->with('menu_types',$menu_types)->with('menu_id',$menu_id)->with('records',$records)->with('menus',$menus);
    }

    public function getMenusList($menu_id,$parent_id = 0){
        $menus = array();
        if(!empty($menu_id)){
            $records = MenuPage::where('menu_id',$menu_id)->where('parent_id',$parent_id)->OrderBy('sort_number','ASC')->get();
            
            if(!empty($records)){
                $i = 1;
                foreach($records as $record){
                    
                    $menusArr  = array();
                    $menusArr['id'] = $record['id'];
                    $menusArr['text'] = $record['title'];
                    $menusArr['href'] = $record['slug'];
                    $menusArr['page_type'] = $record['page_type'];
                    $menusArr['parent_id'] = $record['parent_id'];
                    $menusArr['sort_number'] = $record['sort_number'];
                    $menusArr['status'] = $record['status'];
                    $menusArr['new_tab'] = $record['new_tab'];
                    $menusArr['children'] = $this->getChildMenusList($menu_id,$record['id']);
                    
                    if(!empty($menusArr['children'])){
                        $this->getMenusList($menu_id,$record['id']);
                    }else{
                        unset($menusArr['children']);
                    }
                    
                    if($i == 1){
                        $menusArr['target'] = '_top';
                    }
                    $menus[$record['id']] = $menusArr;
                    
                    $i++;
                }
            }            
            $menus = !empty($menus) ? array_values($menus) : '';
            return $menus;
        }
    }

    public function getChildMenusList($menu_id,$parent_id = 0){
        $menus = array();
        if(!empty($menu_id)){
            $records = MenuPage::where('menu_id',$menu_id)->where('parent_id',$parent_id)->OrderBy('sort_number','ASC')->get();
            
            if(!empty($records)){
                $i = 1;
                foreach($records as $record){
                    
                    $menusArr  = array();
                    $menusArr['id'] = $record['id'];
                    $menusArr['text'] = $record['title'];
                    $menusArr['href'] = $record['slug'];
                    $menusArr['page_type'] = $record['page_type'];
                    $menusArr['parent_id'] = $record['parent_id'];
                    $menusArr['sort_number'] = $record['sort_number'];
                    $menusArr['status'] = $record['status'];
                    $menusArr['new_tab'] = $record['new_tab'];
                    $menusArr['children'] = $this->getMenusList($menu_id,$record['id']);
                    
                    if(empty($menusArr['children'])){
                        unset($menusArr['children']);
                    }
                    
                    $menus[$record['id']] = $menusArr;                    
                    $i++;
                }                
            }            
            $menus = !empty($menus) ? array_values($menus) : '';
            return $menus;
        }        
    }

    public function ajaxGetMenuLinks(Request $request){
        $menuLinks = array();
        return view('admin.menu.ajax_get_menu_links')->with('menuLinks',$menuLinks);
    }

    public function save_menu_links(Request $request){
        if(!empty($request->menu_id)){
            $sort_number = $this->getSortNumber($request->menu_id,0);            
            $menuPage = new MenuPage;

            $menuPage->title = trim($request->link_text);
            $menuPage->slug = trim($request->url);
            $menuPage->menu_id = trim($request->menu_id);
            $menuPage->status  = 1;
            $menuPage->sort_number  = $sort_number;
            $menuPage->page_type  = $request->link_type;
            
            $menuPage->save();
        }
        return redirect()->back();
    }    
    
    public function ajaxSaveMenuStructure(Request $request){
        $result = 0;
        if(isset($request->ajax_request) && $request->ajax_request == "saveMenuStructure"){
            
            if(!empty($request->menuData)){
                
                MenuPage::where('menu_id', '=', $request->menu_id)->update(['sort_number' => 0]);                
                
                $menusData = json_decode($request->menuData);
                
                $this->saveMenuStructure($menusData, $request->menu_id);
                
                $result = 1;
            }            
        }
        echo $result; die;
    }    
    
    public function ajaxDeleteMenuPage(Request $request){
        $result = 0;
        
        if(isset($request->ajax_request) && $request->ajax_request == "deleteMenuPage"){
            
            if(!empty($request->menupage_id)){
                
                $menuPage = MenuPage::find($request->menupage_id);
                $menuPage->delete();
                
                $result = 1;
            }            
        }        
        echo $result;
    }
    
    
    public function ajaxMenuPageDetail(Request $request){
        
        $result = array();
        $result['res'] = 0;
        if(isset($request->ajax_request) && $request->ajax_request == "menuPageDetail"){
            
            if(!empty($request->menupage_id)){
                
                $data = MenuPage::find($request->menupage_id);
                
                if(!empty($data)){
                    $result['res'] = 1;
                    $result['response']['id'] = $data['id'];
                    $result['response']['menu_id'] = $data['menu_id'];
                    $result['response']['title'] = $data['title'];
                    $result['response']['slug'] = $data['slug'];
                    $result['response']['status'] = $data['status'];
                    $result['response']['new_tab'] = $data['new_tab'];
                    $result['response']['page_type'] = $data['page_type'];                    
                }
            }            
        }
        echo json_encode($result); die;
    }
    
    
    public function ajaxEditMenuPage(Request $request){
        $result = 0;
        
        if(isset($request->ajax_request) && $request->ajax_request == "editMenuPage"){
            $menu_page_id = (isset($request->menu_page_id) && !empty($request->menu_page_id)) ? $request->menu_page_id : '';
            
            if(!empty($menu_page_id)){
                $menuPage = MenuPage::find($menu_page_id);
                $menuPage->title = isset($request->menu_title) ? $request->menu_title : '';
                $menuPage->slug = isset($request->menu_slug) ? $request->menu_slug : '';
                $menuPage->status = isset($request->menu_status) ? $request->menu_status : '';
                $menuPage->new_tab = isset($request->menu_new_tab) ? $request->menu_new_tab : '';
                $menuPage->save();
                $result = 1;
            }
        }
        
        echo $result; die;
    }    
    
    public function saveMenuStructure($menusData,$menu_id, $parent_id = 0){
        
        if(!empty($menusData)){
            
            foreach($menusData as $menu_data){
                
                $sort_number = $this->getSortNumber($menu_id,$parent_id);
                
                $menuPage = MenuPage::find($menu_data->id);
                $menuPage->parent_id = $parent_id;
                $menuPage->sort_number = $sort_number;
                $menuPage->save();
                
                if(isset($menu_data->children) && !empty($menu_data->children)){
                    $this->saveMenuStructure($menu_data->children,$menu_id, $menu_data->id);
                }
            }            
        }
    }    
    
    public function getSortNumber($menu_id,$parent_id){
        $last_record = MenuPage::select('id','menu_id','parent_id','sort_number')->where('menu_id',$menu_id)->where('parent_id',$parent_id)->orderBy('sort_number','desc')->first();
        
        $sort_number = !empty($last_record) ? $last_record['sort_number'] + 1 : 0;
        
        return $sort_number; 
    }
}
