<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Entity\Formacao;
use Alura\Cursos\Helper\FlashMessageTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SalvarFormacao implements RequestHandlerInterface
{
    use FlashMessageTrait;

    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $parametrosBody = $request->getParsedBody();

        $descricao = filter_var($parametrosBody['descricao'], FILTER_SANITIZE_STRING);

        $formacao = new Formacao();
        $formacao->setDescricao($descricao);

        $parametrosQuery = $request->getQueryParams();

        if (isset($parametrosQuery['id'])) {
            $id = filter_var($parametrosQuery['id'], FILTER_VALIDATE_INT);
            if (is_null($id) || $id === false) {
                $this->defineMensagem('danger', 'Id inválido do curso');
                return new Response(403, ['Location' => '/listar-cursos']);
            }
            $formacao->setId($id);
            $this->entityManager->merge($formacao);
            $mensagem = 'Formação editada com sucesso';
        } else {
            $this->entityManager->persist($formacao);
            $mensagem = 'Formação inserida com sucesso';
        }

        $this->entityManager->flush();

        $tipo = 'success';
        $this->defineMensagem($tipo, $mensagem);

        return new Response(302, ['Location' => '/listar-cursos']);
    }
}