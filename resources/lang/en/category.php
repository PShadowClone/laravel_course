<?php


return [

    /**
     *
     * titles translations
     *
     */
    'titles' => [
        'categories' => 'Categories',
        'add_category' => 'Add Category',
        'edit_category' => 'Edit Category',

    ],
    /**
     *
     * fields translations
     *
     */
    'fields' => [
        'name' => 'Name',
        'language' => 'Language',
    ],
    /**
     *
     * validation translations
     *
     */
    'validations' => [
        'name_required' => 'Category name is required',
        'name_min' => 'Name characters\' number should be more than 3 characters',
        'lang_required' => 'Category\'s language is required',
        'lang_in' => 'Language should be English or Arabic',
        'category_image_required' => 'Category\'s image is required',
    ],
    /**
     *
     * success messages
     *
     */
    'success' => [
        'stored' => 'Category saved successfully',
        'can_delete' => 'category could be deleted',
        'deleted' => 'category deleted successfully',
        'updated' => 'Category has been updated successfully'
    ],
    /**
     *
     * error messages
     *
     */
    'error' => [
        'stored' => 'something went wrong while saving category',
        'can_not_delete' => 'Category could not be deleted because it has available books',
        'deleted' => 'Something went wrong while deleting category',
        'not_found' => 'Category is not found',
    ],

    /**
     *
     * questions
     *
     */
    'questions' => [
        'do_remove' => 'Do you want to remove category?'
    ]
];