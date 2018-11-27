<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Models\Category;

class ArticleController extends Controller
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
        $grid = new Grid(new Article);

        $grid->id('ID')->sortable();
        $grid->column('category.name','栏目')->sortable();
        $grid->title('标题')->editable();
        $grid->column('picture','图片')->image('',100,100);
        $grid->click_count('点击数')->sortable();
        $grid->slug('静态名')->editable();
        $grid->order('排序')->editable();
        $grid->status('状态')->sortable()->switch(config('form.status_options'));
        $grid->attribute('属性')->checkbox(config('form.attribute_options'));
        $grid->created_at('创建时间')->sortable();

        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            $filter->like('title', '标题');
            $filter->between('created_at', '创建时间')->datetime();
            $filter->scope('new', '最近修改')
                ->whereDate('created_at', date('Y-m-d'))
                ->orWhere('updated_at', date('Y-m-d'));

        });

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
        $show = new Show(Article::findOrFail($id));

        $show->id('Id');
        $show->category_id('Category id');
        $show->title('Title');
        $show->content('Content');
        $show->excerpt('Excerpt');
        $show->picture('Picture');
        $show->picture_set('Picture set');
        $show->author('Author');
        $show->source('Source');
        $show->click_count('Click count');
        $show->slug('Slug');
        $show->order('Order');
        $show->status('Status');
        $show->attribute('Attribute');
        $show->seo_title('Seo title');
        $show->seo_keywords('Seo keywords');
        $show->seo_description('Seo description');
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
        $form = new Form(new Article);

        $category_model = new Category();
        $options = $category_model->getCategoryOptionsTree(2,false);
        $form->select('category_id', '栏目')->options($options)->rules('required');
        $form->text('title', '标题')->rules('required');
        $form->editor('content', '内容')->rules('required');
        $form->textarea('excerpt', '摘要');
        $form->image('picture', '图片');
        $form->multipleImage('picture_set', '图片集')->removable();
        $form->text('author', '作者');
        $form->text('source', '来源');
        $form->number('click_count', '点击数');
        $form->text('slug', '静态名');
        $form->number('order', '排序');
        $form->switch('status', '状态')->default(1);
        $form->checkbox('attribute', '属性')->options(config('form.attribute_options'));
        $form->text('seo_title', 'Seo 标题');
        $form->text('seo_keywords', 'Seo 关键词');
        $form->textarea('seo_description', 'Seo 描述');

        return $form;
    }
}