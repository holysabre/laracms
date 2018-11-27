<?php

namespace App\Admin\Controllers;

use App\Models\Guestbook;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class GuestbookController extends Controller
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
        $grid = new Grid(new Guestbook);

        $grid->id('Id');
        $grid->category_id('Category id');
        $grid->title('Title');
        $grid->content('Content');
        $grid->name('Name');
        $grid->mobile('Mobile');
        $grid->email('Email');
        $grid->address('Address');
        $grid->ip('Ip');
        $grid->extra('Extra');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

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
        $show = new Show(Guestbook::findOrFail($id));

        $show->id('Id');
        $show->category_id('Category id');
        $show->title('Title');
        $show->content('Content');
        $show->name('Name');
        $show->mobile('Mobile');
        $show->email('Email');
        $show->address('Address');
        $show->ip('Ip');
        $show->extra('Extra');
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
        $form = new Form(new Guestbook);

        $form->number('category_id', 'Category id');
        $form->text('title', 'Title');
        $form->textarea('content', 'Content');
        $form->text('name', 'Name');
        $form->mobile('mobile', 'Mobile');
        $form->email('email', 'Email');
        $form->text('address', 'Address');
        $form->ip('ip', 'Ip');
        $form->textarea('extra', 'Extra');

        return $form;
    }
}
