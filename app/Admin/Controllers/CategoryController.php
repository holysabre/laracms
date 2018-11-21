<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;
use Encore\Admin\Tree;
use Encore\Admin\Facades\Admin;

class CategoryController extends Controller
{
    use HasResourceActions;

    private $category_model;

    public function __construct()
    {
        $this->category_model = new Category();
    }

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('Edit')
                ->description('description')
                ->body(Category::tree());
        });
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
//        dump(Category::tree());
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category);

        $grid->id('Id');
        $grid->parent_id('父ID');
        $grid->name('名称');
        $grid->order('排序');
        $grid->image('图片');
        $grid->index_template('首页模版');
        $grid->detail_template('详情模版');
        $grid->status('Status')->display(function ($status){
            return $status ? '<p class="text-success">启用</p>' : '<p class="text-muted">禁用</p>';
        });
        $grid->created_at('创建时间');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Category::findOrFail($id));

        $show->id('Id');
        $show->parent_id('Parent id');
        $show->name('Name');
        $show->order('Order');
        $show->alias('Alias');
        $show->icon('Icon');
        $show->image('Image');
        $show->link('Link');
        $show->seo_title('Seo title');
        $show->seo_keywords('Seo keywords');
        $show->seo_description('Seo description');
        $show->index_template('Index template');
        $show->detail_template('Detail template');
        $show->status('Status');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category);

        $form->select('parent_id', '父ID')->options($this->category_model->getCategoryOptions());
        $form->text('name', 'Name');
        $form->number('order', 'Order');
        $form->text('alias', 'Alias');
        $form->text('icon', 'Icon');
        $form->image('image', 'Image');
        $form->url('link', 'Link');
        $form->text('seo_title', 'Seo title');
        $form->text('seo_keywords', 'Seo keywords');
        $form->textarea('seo_description', 'Seo description');
        $form->text('index_template', 'Index template');
        $form->text('detail_template', 'Detail template');
        $form->switch('status', 'Status')->default(1);

        dump($form);
        $form->saving(function (Form $form) {

            if(!empty($form->model()->id)){
                $arr = arrayListKey($this->category_model->all()->toArray());
                dd([$form->model()->id,$form->parent_id]);
                $is_self = arrayIsSelf($arr,$form->model()->id,$form->parent_id);

                if($is_self){
                    $error = new MessageBag([
                        'title'   => '父ID值有误',
                        'message' => '父ID不允许为自身',
                    ]);

                    return back()->with(compact('error'));
                }
            }

        });

        return $form;
    }
}
