<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

use App\Http\Requests;
use App\Author;
use App\Quotes;
use App\Events\QuoteCreated;


use App\Http\Requests\CreateQuotesRequest;

class QuoteController extends Controller
{

	public function getIndex( $author = null )
	{ 
        if(!is_null($author)){

            $quote_author = Author::where('name', $author)->first();

                if($quote_author){

                    $quotes = $quote_author->quotes()->orderBy('created_at', 'desc')->paginate(6);

                }
                  
        }else{

                    $quotes = Quotes::orderBy('created_at', 'desc')->paginate(6);

                }
		
		return view('index', ['quotes' => $quotes]);

	}

    public function postCreate(CreateQuotesRequest $request)
    {

    	$authorName = ucfirst($request['name']);
    	$quoteText = $request['quote'];
        $email = $request['email'];

    	$author = Author::where('name', $authorName)->first();

    	if(!$author){

    		$author = new Author();
    		$author->name = $authorName;
            $author->email = $request['email'];
    		$author->save();
		}

		$quote = new Quotes();
		$quote->quote = $quoteText;

		$author->quotes()->save($quote);

        Event::fire(new QuoteCreated($author));

		return redirect()->route('home')->with([
			'message' => 'Quotes Saved !'
		]); 

    }


    public function getDelete($id)
    {
    	$quote = Quotes::find($id);
    	$author_deleted = false;
    		if(count($quote->author->quotes) === 1){

    			$quote->author->delete();
    			$author_deleted = true;
    		}

    	$quote->delete();
    	$msg = $author_deleted ? 'Quote and author deleted' : 'Quote Deleted';
    	return redirect()->route('home')->with(['message' => $msg]);
	}

    
}