<?php

namespace App\Admin\Controllers;

use App\Models\Page;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Models\Category;

class PageController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
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
        $grid = new Grid(new Page);

        $grid->id('ID');
        //
//        $grid->category_id('分类')->display(function ($category_id){
//            $category = Category::find($category_id);
//            return $category ? $category->name : $category_id;
//        });
        $grid->column('category.name');//一对一模型
        $grid->title('标题');
//        $grid->content('内容');
//        $grid->excerpt('摘要');
        $grid->slug('静态名');
        $grid->order('排序');
        $grid->status('Status')->display(function ($status){
            return $status ? '<p class="text-success">启用</p>' : '<p class="text-muted">禁用</p>';
        });
        $grid->created_at('创建时间');
//        $grid->updated_at('修改时间');

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
        $show = new Show(Page::findOrFail($id));

        $show->id('ID');
        $show->category_id('分类');
        $show->title('标题');
        $show->content('内容');
        $show->excerpt('摘要');
        $show->slug('静态名');
        $show->order('排序');
        $show->status('状态');
        $show->created_at('创建时间');
        $show->updated_at('修改时间');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Page);

        $category_model = new Category();
        $options = $category_model->getCategoryOptionsTree(1);
        $form->select('category_id', '分类')->options($options);
        $form->text('title', '标题');
        $form->editor('content', '内容');
        $form->text('excerpt', '摘要');
        $form->text('slug', '静态名');
        $form->number('order', '排序');
        $form->switch('status', '状态')->default(1);

        return $form;
    }
}
