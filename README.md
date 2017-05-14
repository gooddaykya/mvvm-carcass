# mvvm-carcass
MVVM design pattern based PHP framework.

# ToC
1. Structure
2. Layer description

# 1. Structure

/
|-index.php
|
|-Components
        |-Autoloader
        |-Database
                |-PDOBase               implements DatabaseAdapter
|
|-Configuration
        |-Requisites
|
|
|-Controllers
        |-ArticleController
|
|-FrontController
        |-FFC
                |-Analyzer
                |-DiC
                |-FullRequests  implements RequestsAdapter
                |-Router
                |-Routes                implememts RoutesAdapter
|
|-Interfaces
        |-DatabaseAdapter
        |-ModelAdapter
        |-RequestsAdapter
        |-RoutesAdapter
        |-TemplateAdapter
        |-ViewModelAdapter
        |-ViewTemplateAdapter
|
|-Layouts
        |-ArticleLayout
        |-TopicsLayout
|
|-Model
        |-Article                       extends ParentModel
        |-ParentModel           implements ModelAdapter                 abstract
|
|-Templates
        |-HTMLTemplate          implements TemplateAdapter
|
|-ViewModel
        |-ParentViewModel       implements ViewModelAdapter             abstract
        |-ViewList                      extends ParentViewModel
        |-ViewOne                       extends ParentViewModel
|
|-Views
        |-ViewTemplates
                |-ArticleView   extends ParentViewTemplate
                |-ParentViewTemplate
                                                implements ViewTemplateAdapter
                |-TopicsView    extends ParentViewTemplate

# Layer description
