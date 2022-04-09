<?php

namespace Abr4xas\SimpleBlog\Database\Factories;

use Abr4xas\SimpleBlog\Models\Article;
use Abr4xas\SimpleBlog\Models\Enums\ArticleStatus;
use Illuminate\Database\Eloquent\Factories\Factory;


class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $title = $this->faker->sentence;

        return [
            'title' => $title,
            'excerpt' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'body' => $this->content(),
            'file' => $this->faker->imageUrl($width = 1200, $height = 400),
            'status' => $this->faker->randomElement([
                ArticleStatus::PUBLISHED(),
                ArticleStatus::DRAFT()
            ]),
            'created_at' => $this->faker->dateTimeBetween('-20 weeks', 'now')
        ];
    }

    public function published()
    {
        return $this->state([
            'status' => ArticleStatus::PUBLISHED()
        ]);
    }

    public function draft()
    {
        return $this->state([
            'status' => ArticleStatus::DRAFT()
        ]);
    }

    public function withAuthor()
    {
        $author = \Abr4xas\SimpleBlog\Tests\Models\User::factory()->create();
        return $this->state([
            'author_id' => $author->id,
            'author_type' => \Abr4xas\SimpleBlog\Tests\Models\User::class,
        ]);
    }

    public function content()
    {
        return '
            # Lorem ipsum dolor sit amet, consectetur adipiscing elit.

            Nam condimentum, nibh a sollicitudin lacinia, massa diam tempor leo, sit amet vestibulum massa eros ut odio. Aliquam ac rutrum ligula, porta bibendum dui. Morbi mollis augue nec tempor laoreet. Fusce vestibulum justo at convallis efficitur. Nulla porttitor efficitur tellus vitae pharetra. Nullam interdum erat semper, sollicitudin massa blandit, pellentesque orci. Suspendisse et mollis quam. Phasellus a convallis est. Fusce eu ante risus. Aliquam erat volutpat. Morbi viverra, lorem et luctus semper, est arcu accumsan libero, in aliquet nisl nisl non eros. Donec elit turpis, lacinia rhoncus consectetur eu, tincidunt eget nibh. Duis et elit elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla in tempor ipsum.

            ## Quisque tempor ante lacus, id dapibus massa malesuada id.

            Mauris malesuada feugiat suscipit. Nullam ultricies lorem auctor nulla vulputate, fermentum imperdiet enim convallis. Vivamus quis mollis ligula. Nullam quis imperdiet quam, quis maximus sem. Ut viverra tristique sagittis. Maecenas maximus sit amet neque vitae accumsan. Aenean egestas nulla vel ipsum blandit fermentum. Etiam hendrerit consectetur quam, tincidunt pellentesque quam ultricies commodo. Curabitur suscipit metus a magna aliquet, ac rutrum lorem rhoncus.

            Cras ut feugiat eros, vitae vehicula tortor. Aenean a nunc ut augue mollis semper. Morbi diam magna, eleifend vitae purus quis, rhoncus tincidunt purus. Nunc dignissim pulvinar tortor, non malesuada nisl pharetra non. Duis egestas lobortis augue, vel vehicula tortor mollis eget. Sed maximus velit odio, varius sollicitudin orci convallis ac. Ut condimentum efficitur tempus.

            - Maecenas scelerisque mauris nec risus tincidunt congue.
            - Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            - In efficitur faucibus sapien ac suscipit.
            - Fusce leo urna, rhoncus vitae ultricies sit amet,  iaculis non tortor.
            - Duis vestibulum felis ac arcu aliquet, et pharetra risus aliquet.

            > Maecenas eget lacinia magna, eu lobortis libero. Curabitur quis risus
            > quis eros viverra gravida eget a lacus. Morbi id ante pulvinar,
            > rhoncus leo vitae, vulputate sapien.

            Aenean luctus nulla dignissim urna blandit vulputate. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eget pulvinar ante. Donec ut ornare sem. Vestibulum quis velit at dolor pretium sollicitudin sit amet et ex. Integer eu eros eget nulla pharetra lobortis sollicitudin et erat. Mauris sed neque porta, cursus tellus cursus, aliquet purus. Nulla aliquam urna sit amet justo ornare tincidunt. Fusce bibendum ultrices nisi. Phasellus vestibulum nisl et justo aliquam, eget condimentum velit ullamcorper. Curabitur volutpat lectus maximus sodales scelerisque. Cras convallis, diam eu faucibus tempus, libero leo gravida dolor, varius facilisis eros lorem eget turpis.

            Proin euismod nunc non erat tincidunt, ut bibendum sem interdum. Sed commodo ultricies nisl. Aliquam maximus et ex eu accumsan. Nunc quis urna sed mi mollis gravida nec rhoncus nisl. Mauris placerat egestas nisl, et scelerisque risus ultricies ut. Nullam tincidunt, est ut porta bibendum, nibh velit aliquam augue, non lacinia lectus erat id nibh. Suspendisse potenti. Praesent orci mauris, ultrices sit amet elementum at, vestibulum et tellus. Fusce imperdiet justo vitae pellentesque tincidunt. Etiam eleifend eget nulla sed venenatis. Aliquam congue dui vitae iaculis blandit. Cras est massa, dapibus tincidunt tempor nec, accumsan a dolor. Donec bibendum, massa a bibendum egestas, augue odio varius erat, vel pulvinar mi mauris eu nisl. Mauris pretium mauris vitae sapien pellentesque, et fermentum lacus ultrices.
        ';
    }
}
