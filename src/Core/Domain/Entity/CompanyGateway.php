<?php

namespace Core\Domain\Entity;

class CompanyGateway
{
    public function __construct(
        private ?int $id = null,
        private int $idCompany,
        private string $nameGateway,
        private string $publicKey,
        private string $liveApiKey,
        private string $recipientId
    ) {}

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCompany(): int
    {
        return $this->idCompany;
    }

    public function getNameGateway(): string
    {
        return $this->nameGateway;
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function getLiveApiKey(): string
    {
        return $this->liveApiKey;
    }

    public function getRecipientId(): string
    {
        return $this->recipientId;
    }

    // Setters
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
