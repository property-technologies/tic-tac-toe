<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * Rules Page Test
 */
class RulesPageTest extends TestCase
{
    /**
     * Helper method to get rules page output
     *
     * @return string
     */
    private function getRulesPageOutput(): string
    {
        $phpBinary = escapeshellarg(PHP_BINARY);
        $scriptPath = escapeshellarg(__DIR__ . '/../public/rules.php');
        $command = $phpBinary . ' ' . $scriptPath;

        $output = shell_exec($command);

        return $output !== null ? $output : '';
    }

    /**
     * Test rules page contains HTML content
     *
     * @runInSeparateProcess
     */
    public function testRulesPageContainsHtml(): void
    {
        $output = $this->getRulesPageOutput();
        
        $this->assertStringContainsString('<!DOCTYPE html>', $output);
        $this->assertStringContainsString('<html lang="ja">', $output);
    }

    /**
     * Test rules page contains title
     *
     * @runInSeparateProcess
     */
    public function testRulesPageContainsTitle(): void
    {
        $output = $this->getRulesPageOutput();
        
        $this->assertStringContainsString('<title>ゲームルール - マルバツゲーム</title>', $output);
    }

    /**
     * Test rules page contains main heading
     *
     * @runInSeparateProcess
     */
    public function testRulesPageContainsMainHeading(): void
    {
        $output = $this->getRulesPageOutput();
        
        $this->assertStringContainsString('<h1>マルバツゲームのルール</h1>', $output);
    }

    /**
     * Test rules page contains basic rules section
     *
     * @runInSeparateProcess
     */
    public function testRulesPageContainsBasicRules(): void
    {
        $output = $this->getRulesPageOutput();
        
        $this->assertStringContainsString('基本ルール', $output);
        $this->assertStringContainsString('Tic-Tac-Toe', $output);
    }

    /**
     * Test rules page contains game objective
     *
     * @runInSeparateProcess
     */
    public function testRulesPageContainsGameObjective(): void
    {
        $output = $this->getRulesPageOutput();
        
        $this->assertStringContainsString('ゲームの目的', $output);
        $this->assertStringContainsString('3つ揃える', $output);
    }

    /**
     * Test rules page contains how to play section
     *
     * @runInSeparateProcess
     */
    public function testRulesPageContainsHowToPlay(): void
    {
        $output = $this->getRulesPageOutput();
        
        $this->assertStringContainsString('遊び方', $output);
    }

    /**
     * Test rules page contains winning conditions
     *
     * @runInSeparateProcess
     */
    public function testRulesPageContainsWinningConditions(): void
    {
        $output = $this->getRulesPageOutput();
        
        $this->assertStringContainsString('勝利条件', $output);
        $this->assertStringContainsString('横一列', $output);
        $this->assertStringContainsString('縦一列', $output);
        $this->assertStringContainsString('斜め', $output);
    }

    /**
     * Test rules page contains link back to game
     *
     * @runInSeparateProcess
     */
    public function testRulesPageContainsLinkToGame(): void
    {
        $output = $this->getRulesPageOutput();
        
        $this->assertStringContainsString('ゲームで遊ぶ', $output);
        $this->assertStringContainsString('href="/"', $output);
    }

    /**
     * Test rules page includes CSS files
     *
     * @runInSeparateProcess
     */
    public function testRulesPageIncludesCssFiles(): void
    {
        $output = $this->getRulesPageOutput();
        
        $this->assertStringContainsString('assets/css/style.css', $output);
        $this->assertStringContainsString('assets/css/rules.css', $output);
    }
}
