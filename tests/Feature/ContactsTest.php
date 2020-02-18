<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Contact;
use Tests\TestCase;
use App\User;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class ContactsTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }


    private function data() {
        return [
            'name' => 'test',
            'email' => 'test@email.com',
            'birthday' => '12.12.2020',
            'company' => 'ABC',
            'api_token' => $this->user->api_token,
        ];
    }


    /**
     * @test
     *
     * @return void
     */
    public function a_list_of_contacts_can_be_fetched_for_the_authenticated_user()
    {
        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $contact = factory(Contact::class)->create(['user_id' => $user->id]);
        $contact2 = factory(Contact::class)->create(['user_id' => $user2->id]);

        $response = $this->get('/api/contacts?api_token='.$user->api_token);

        //dd(json_decode($response->getContent()));
        //dd(json_decode($response->getContent()));

        $response->assertJsonCount(1)
            ->assertJson([
                'data' => [
                    ['data' => ['contact_id' => $contact->id]]
                ]
            ]);
        
    }




    /** 
     * @test
     */
   
    public function required_fields()
    {
        collect(['name', 'email', 'birthday', 'company'])
            ->each(function($substract){
                $response = $this->post('/api/contacts', array_merge($this->data(), [$substract => '']));
                $response->assertSessionHasErrors($substract);
                $this->assertCount(0,Contact::all());
            });

    }

    /**
     * @test
     */
    public function email_must_be_valid()
    {
        $response = $this->post('/api/contacts', $this->data());
        $response->assertSessionHasNoErrors('email');
    }

    /**
     * @test
     */
    public function birthday_must_be_a_date()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/contacts', $this->data());
        $this->assertCount(1, Contact::all());
        $this->assertInstanceOf(Carbon::class, Contact::first()->birthday);
        $this->assertEquals('12.12.2020', Contact::first()->birthday->format('d.m.Y'));
    }

    /**
     * @test
     */
    public function a_contact_can_be_retrieved()
    {
        $contact = factory(Contact::class)->create(['user_id' => $this->user->id]);
        
        $response = $this->get("/api/contacts/".$contact->id."?api_token=".$this->user->api_token);

        //dd(json_decode($response->getContent()));
        $response->assertJson([
            "data" => [
                'name' => $contact->name,
                'email' => $contact->email,
                'birthday' => $contact->birthday->format('d.m.Y'),
                'company' => $contact->company,
                'last_updated' => $contact->updated_at->diffForHumans(),
            ]
            
        ]);
    }

    /**
     * @test
     */
    public function only_the_users_contacts_can_be_retrieved()
    {
        $contact = factory(Contact::class)->create(['user_id' => $this->user->id]);
        $user2 = factory(User::class)->create();
        
        $response = $this->get("/api/contacts/".$contact->id."?api_token=".$user2->api_token);

        $response->assertStatus(403);
    }



    /**
     * @test
     *
     * @return void
     */
    public function a_contact_can_be_patched()
    {
        $contact = factory(Contact::class)->create(['user_id' => $this->user->id]);
        $response = $this->patch('/api/contacts/'.$contact->id, $this->data());
        $contact = $contact->fresh();
        
        $this->assertEquals('test', $contact->name);
        $this->assertEquals('test@email.com', $contact->email);
        $this->assertEquals('12.12.2020', $contact->birthday->format("d.m.Y"));
        $this->assertEquals('ABC', $contact->company);
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'contact_id' => $contact->id,
            ],
            'links' => [
                'self' => $contact->path(),
            ]
        ]);
    }

    /**
     * @test
     */
    public function only_the_owner_of_contact_patch_the_contact()
    {
        $outsider = factory(User::class)->create();
        $contact = factory(Contact::class)->create(['user_id' => $outsider->id]);
        $response = $this->patch('/api/contacts/'.$contact->id, $this->data());
        
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function a_contact_can_be_deleted()
    {
        $contact = factory(Contact::class)->create(['user_id' => $this->user->id]);
        $response = $this->delete('/api/contacts/'.$contact->id, ['api_token' => $this->user->api_token]);

        $response->assertStatus(204);
        $this->assertCount(0, Contact::all());
    }

    /**
     * @test
     */
    public function only_the_owner_can_delete_a_contact()
    {
        $user = factory(User::class)->create();
        $contact = factory(Contact::class)->create(['user_id' => $user->id]);
        $response = $this->delete('/api/contacts/'. $contact->id, ['api_token' => $this->user->api_token]);

        $response->assertStatus(403);

    }

    /**
     * @test
     */
    public function an_unauthorized_user_redirect_to_login()
    {
        $response = $this->post('/api/contacts', array_merge($this->data(), ['api_token' => '']));
        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function an_authendicated_user_can_add_a_contact()
    {
        $user = factory(User::class)->create();

        $response = $this->post('/api/contacts', $this->data());
        //dd(json_decode($response->getContent()));
        $contact = Contact::first();
        $this->assertEquals('test', $contact->name);
        $response->assertStatus(Response::HTTP_CREATED); // 201
        $response->assertJson([
            'data' => [
                'contact_id' => $contact->id,
            ],
            'links' => [
                'self' => $contact->path(),
            ]
        ]);
    }

    
    
}
