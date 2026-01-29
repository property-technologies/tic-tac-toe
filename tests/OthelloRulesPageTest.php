<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * Othello Rules Page Test
 */
class OthelloRulesPageTest extends TestCase
{
    /**
     * Helper method to get othello rules page output
     *
     * @return string
     */
    private function getOthelloRulesPageOutput(): string
    {
        $phpBinary = escapeshellarg(PHP_BINARY);
        $scriptPath = escapeshellarg(__DIR__ . '/../public/othello-rules.php');
        $command = $phpBinary . ' ' . $scriptPath . ' 2>&1';

        $output = shell_exec($command);

        if ($output === null) {
            $this->fail('Failed to execute PHP script');
        }

        return $output;
    }

    /**
     * Test othello rules page contains HTML content
     *
     * @runInSeparateProcess
     */
    public function testOthelloRulesPageContainsHtml(): void
    {
        $output = $this->getOthelloRulesPageOutput();
        
        $this->assertStringContainsString('<!DOCTYPE html>', $output);
        $this->assertStringContainsString('<html lang="ja">', $output);
    }

    /**
     * Test othello rules page contains title
     *
     * @runInSeparateProcess
     */
    public function testOthelloRulesPageContainsTitle(): void
    {
        $output = $this->getOthelloRulesPageOutput();
        
        $this->assertStringContainsString('<title>ゲームルール - オセロ</title>', $output);
    }

    /**
     * Test othello rules page contains main heading
     *
     * @runInSeparateProcess
     */
    public function testOthelloRulesPageContainsMainHeading(): void
    {
        $output = $this->getOthelloRulesPageOutput();
        
        $this->assertStringContainsString('<h1>オセロのルール</h1>', $output);
    }

    /**
     * Test othello rules page contains basic rules section
     *
     * @runInSeparateProcess
     */
    public function testOthelloRulesPageContainsBasicRules(): void
    {
        $output = $this->getOthelloRulesPageOutput();
        
        $this->assertStringContainsString('基本ルール', $output);
        $this->assertStringContainsString('Othello', $output);
    }

    /**
     * Test othello rules page contains game objective
     *
     * @runInSeparateProcess
     */
    public function testOthelloRulesPageContainsGameObjective(): void
    {
        $output = $this->getOthelloRulesPageOutput();
        
        $this->assertStringContainsString('ゲームの目的', $output);
        $this->assertStringContainsString('反転', $output);
    }

    /**
     * Test othello rules page contains how to play section
     *
     * @runInSeparateProcess
     */
    public function testOthelloRulesPageContainsHowToPlay(): void
    {
        $output = $this->getOthelloRulesPageOutput();
        
        $this->assertStringContainsString('遊び方', $output);
    }

    /**
     * Test othello rules page contains winning conditions
     *
     * @runInSeparateProcess
     */
    public function testOthelloRulesPageContainsWinningConditions(): void
    {
        $output = $this->getOthelloRulesPageOutput();
        
        $this->assertStringContainsString('勝利条件', $output);
    }

    /**
     * Test othello rules page contains placement rules
     *
     * @runInSeparateProcess
     */
    public function testOthelloRulesPageContainsPlacementRules(): void
    {
        $output = $this->getOthelloRulesPageOutput();
        
        $this->assertStringContainsString('配置可能な場所の条件', $output);
        $this->assertStringContainsString('挟める', $output);
    }

    /**
     * Test othello rules page contains link back to game
     *
     * @runInSeparateProcess
     */
    public function testOthelloRulesPageContainsLinkToGame(): void
    {
        $output = $this->getOthelloRulesPageOutput();
        
        $this->assertStringContainsString('ゲームで遊ぶ', $output);
        $this->assertStringContainsString('href="./othello.php"', $output);
    }

    /**
     * Test othello rules page includes CSS files
     *
     * @runInSeparateProcess
     */
    public function testOthelloRulesPageIncludesCssFiles(): void
    {
        $output = $this->getOthelloRulesPageOutput();
        
        $this->assertStringContainsString('assets/css/style.css', $output);
        $this->assertStringContainsString('assets/css/rules.css', $output);
    }
}
