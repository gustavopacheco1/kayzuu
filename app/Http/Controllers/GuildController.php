<?php

namespace App\Http\Controllers;

use App\Http\Requests\Guild\StoreRequest;
use App\Models\Account;
use App\Models\Guild;
use App\Repositories\GuildRepository;
use App\Services\GuildService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class GuildController extends Controller
{
    public function __construct(private GuildRepository $repository, private GuildService $service)
    {
    }

    public function index(): View
    {
        $guilds = Guild::get(['id', 'name']);

        return view('guild.index', ['guilds' => $guilds]);
    }

    public function show(Guild $guild): View
    {
        $guild = $this->repository->getGuildDetails($guild);

        /** @var Account $account */
        $account = auth()->user();

        $isOwner = $account->hasGuildOwner($guild);

        return view('guild.show', [
            'guild' => $guild,
            'isOwner' => $isOwner,
        ]);
    }

    public function create(): View
    {
        /** @var Account $account */
        $account = auth()->user();

        return view('guild.create', ['characters' => $account->characters]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $guild = $this->service->createGuild($request->validated());

        return redirect()->route('guild.show', [$guild->id]);
    }
}
